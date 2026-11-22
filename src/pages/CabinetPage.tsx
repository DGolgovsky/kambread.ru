import { useEffect, useState, type FormEvent } from 'react';
import { Navigate, useNavigate } from 'react-router-dom';
import { LogOut, Plus, Trash2 } from 'lucide-react';
import { apiFetch } from '../lib/api';
import { formatRub, formatRuDate, formatWeight, validateProductInput } from '../lib/catalog';
import { useAuth } from '../context/AuthContext';
import {
  PRODUCT_CATEGORIES,
  type AwardItem,
  type InquiryRecord,
  type NewsItem,
  type Product,
  type ProductCategory,
  type UserProfile,
  type VacancyItem,
} from '../lib/types';
import { PageBanner } from '../components/Layout';

type CabinetTab = 'products' | 'news' | 'vacancies' | 'awards' | 'inquiries' | 'profile';

const IMAGE_PRESETS = [
  { label: 'Хлеб ржаной', value: '/images/products/rye_bread.jpg' },
  { label: 'Батон пшеничный', value: '/images/products/golden_baton.jpg' },
  { label: 'Булочки сдобные', value: '/images/products/sweet_buns.jpg' },
  { label: 'Баранки и сушки', value: '/images/products/baranki_rings.jpg' },
  { label: 'Кекс с изюмом', value: '/images/products/raisin_cake.jpg' },
  { label: 'Арбузный фестиваль', value: '/images/about/watermelon.jpg' },
];

export function CabinetPage() {
  const { user, loading: authLoading, logout, setUser } = useAuth();
  const navigate = useNavigate();
  const [tab, setTab] = useState<CabinetTab>('products');
  const [notice, setNotice] = useState<string | null>(null);
  const [errorMsg, setErrorMsg] = useState<string | null>(null);

  const [products, setProducts] = useState<Product[]>([]);
  const [news, setNews] = useState<NewsItem[]>([]);
  const [vacancies, setVacancies] = useState<VacancyItem[]>([]);
  const [awards, setAwards] = useState<AwardItem[]>([]);
  const [inquiries, setInquiries] = useState<InquiryRecord[]>([]);

  // New Product Form State
  const [prodName, setProdName] = useState('');
  const [prodShortName, setProdShortName] = useState('');
  const [prodPrice, setProdPrice] = useState('');
  const [prodWeight, setProdWeight] = useState('');
  const [prodType, setProdType] = useState<ProductCategory>('Хлеб');
  const [prodImage, setProdImage] = useState(IMAGE_PRESETS[0].value);
  const [prodDesc, setProdDesc] = useState('');
  const [prodNew, setProdNew] = useState(true);
  const [prodRecommend, setProdRecommend] = useState(false);

  // New News Form State
  const [newsTitle, setNewsTitle] = useState('');
  const [newsDesc, setNewsDesc] = useState('');
  const [newsImage, setNewsImage] = useState('/images/slider/2.jpg');

  // New Vacancy Form State
  const [vacTitle, setVacTitle] = useState('');
  const [vacDept, setVacDept] = useState('Производственный цех № 1');
  const [vacSchedule, setVacSchedule] = useState('Сменный график 2/2');
  const [vacDesc, setVacDesc] = useState('');

  // New Award Form State
  const [awardYear, setAwardYear] = useState('2026');
  const [awardDesc, setAwardDesc] = useState('');

  // Profile & Password Form State
  const [profileName, setProfileName] = useState('');
  const [profileEmail, setProfileEmail] = useState('');
  const [profilePhone, setProfilePhone] = useState('');
  const [currentPassword, setCurrentPassword] = useState('');
  const [newPassword, setNewPassword] = useState('');

  const flash = (msg: string) => {
    setErrorMsg(null);
    setNotice(msg);
  };

  const loadAll = async () => {
    try {
      const [pRes, nRes, vRes, aRes, iRes] = await Promise.all([
        apiFetch<{ items: Product[] }>('/api/products?all=1'),
        apiFetch<{ items: NewsItem[] }>('/api/news?all=1'),
        apiFetch<{ items: VacancyItem[] }>('/api/vacancies?all=1'),
        apiFetch<{ items: AwardItem[] }>('/api/awards'),
        apiFetch<{ items: InquiryRecord[] }>('/api/inquiries'),
      ]);
      setProducts(pRes.items);
      setNews(nRes.items);
      setVacancies(vRes.items);
      setAwards(aRes.items);
      setInquiries(iRes.items);
    } catch (err) {
      setErrorMsg(err instanceof Error ? err.message : 'Ошибка загрузки данных');
    }
  };

  useEffect(() => {
    if (user) {
      setProfileName(user.name);
      setProfileEmail(user.email);
      setProfilePhone(user.phone);
      void loadAll();
    }
  }, [user]);

  if (authLoading) {
    return (
      <div className="max-w-7xl mx-auto px-4 py-16">
        <div className="h-64 rounded-xl bg-[#EFE9E0] animate-pulse" />
      </div>
    );
  }

  if (!user) {
    return <Navigate to="/login" replace />;
  }

  const handleLogout = async () => {
    await logout();
    navigate('/');
  };

  const handleCreateProduct = async (e: FormEvent) => {
    e.preventDefault();
    const parsed = {
      name: prodName.trim(),
      shortName: prodShortName.trim(),
      price: Number(prodPrice),
      weight: Number(prodWeight),
      description: prodDesc.trim(),
    };
    const errs = validateProductInput(parsed);
    if (Object.keys(errs).length > 0) {
      setErrorMsg(Object.values(errs)[0]);
      return;
    }
    try {
      const res = await apiFetch<{ item: Product }>('/api/products', {
        method: 'POST',
        body: JSON.stringify({
          ...parsed,
          type: prodType,
          image: prodImage,
          isNew: prodNew,
          isRecommend: prodRecommend,
          published: true,
        }),
      });
      setProducts((prev) => [res.item, ...prev]);
      setProdName('');
      setProdShortName('');
      setProdPrice('');
      setProdWeight('');
      setProdDesc('');
      flash(`Продукция «${res.item.shortName}» добавлена в каталог`);
    } catch (err) {
      setErrorMsg(err instanceof Error ? err.message : 'Ошибка добавления продукции');
    }
  };

  const toggleProductField = async (
    product: Product,
    field: 'published' | 'isNew' | 'isRecommend',
  ) => {
    try {
      const res = await apiFetch<{ item: Product }>(`/api/products/${product.id}`, {
        method: 'PUT',
        body: JSON.stringify({ [field]: !product[field] }),
      });
      setProducts((prev) => prev.map((p) => (p.id === product.id ? res.item : p)));
      flash(`Обновлено изделие «${res.item.shortName}»`);
    } catch (err) {
      setErrorMsg(err instanceof Error ? err.message : 'Ошибка обновления');
    }
  };

  const deleteProduct = async (product: Product) => {
    try {
      await apiFetch(`/api/products/${product.id}`, { method: 'DELETE' });
      setProducts((prev) => prev.filter((p) => p.id !== product.id));
      flash(`Удалено изделие «${product.shortName}»`);
    } catch (err) {
      setErrorMsg(err instanceof Error ? err.message : 'Ошибка удаления');
    }
  };

  const handleCreateNews = async (e: FormEvent) => {
    e.preventDefault();
    try {
      const res = await apiFetch<{ item: NewsItem }>('/api/news', {
        method: 'POST',
        body: JSON.stringify({ title: newsTitle, description: newsDesc, image: newsImage }),
      });
      setNews((prev) => [res.item, ...prev]);
      setNewsTitle('');
      setNewsDesc('');
      flash('Новость опубликована');
    } catch (err) {
      setErrorMsg(err instanceof Error ? err.message : 'Ошибка публикации новости');
    }
  };

  const deleteNews = async (item: NewsItem) => {
    try {
      await apiFetch(`/api/news/${item.id}`, { method: 'DELETE' });
      setNews((prev) => prev.filter((n) => n.id !== item.id));
      flash('Новость удалена');
    } catch (err) {
      setErrorMsg(err instanceof Error ? err.message : 'Ошибка удаления новости');
    }
  };

  const handleCreateVacancy = async (e: FormEvent) => {
    e.preventDefault();
    try {
      const res = await apiFetch<{ item: VacancyItem }>('/api/vacancies', {
        method: 'POST',
        body: JSON.stringify({
          title: vacTitle,
          department: vacDept,
          schedule: vacSchedule,
          description: vacDesc,
          open: true,
        }),
      });
      setVacancies((prev) => [res.item, ...prev]);
      setVacTitle('');
      setVacDesc('');
      flash(`Вакансия «${res.item.title}» добавлена`);
    } catch (err) {
      setErrorMsg(err instanceof Error ? err.message : 'Ошибка добавления вакансии');
    }
  };

  const toggleVacancyOpen = async (item: VacancyItem) => {
    try {
      const res = await apiFetch<{ item: VacancyItem }>(`/api/vacancies/${item.id}`, {
        method: 'PUT',
        body: JSON.stringify({ open: !item.open }),
      });
      setVacancies((prev) => prev.map((v) => (v.id === item.id ? res.item : v)));
      flash(`Статус вакансии «${item.title}» обновлён`);
    } catch (err) {
      setErrorMsg(err instanceof Error ? err.message : 'Ошибка обновления вакансии');
    }
  };

  const deleteVacancy = async (item: VacancyItem) => {
    try {
      await apiFetch(`/api/vacancies/${item.id}`, { method: 'DELETE' });
      setVacancies((prev) => prev.filter((v) => v.id !== item.id));
      flash('Вакансия удалена');
    } catch (err) {
      setErrorMsg(err instanceof Error ? err.message : 'Ошибка удаления вакансии');
    }
  };

  const handleCreateAward = async (e: FormEvent) => {
    e.preventDefault();
    try {
      const res = await apiFetch<{ item: AwardItem }>('/api/awards', {
        method: 'POST',
        body: JSON.stringify({
          year: Number(awardYear),
          description: awardDesc,
          image: '/images/about/watermelon.jpg',
        }),
      });
      setAwards((prev) => [res.item, ...prev]);
      setAwardDesc('');
      flash('Награда добавлена');
    } catch (err) {
      setErrorMsg(err instanceof Error ? err.message : 'Ошибка добавления награды');
    }
  };

  const deleteAward = async (item: AwardItem) => {
    try {
      await apiFetch(`/api/awards/${item.id}`, { method: 'DELETE' });
      setAwards((prev) => prev.filter((a) => a.id !== item.id));
      flash('Награда удалена');
    } catch (err) {
      setErrorMsg(err instanceof Error ? err.message : 'Ошибка удаления награды');
    }
  };

  const handleUpdateProfile = async (e: FormEvent) => {
    e.preventDefault();
    try {
      const res = await apiFetch<{ user: UserProfile }>('/api/profile', {
        method: 'PUT',
        body: JSON.stringify({ name: profileName, email: profileEmail, phone: profilePhone }),
      });
      setUser(res.user);
      flash('Ваш профиль обновлён');
    } catch (err) {
      setErrorMsg(err instanceof Error ? err.message : 'Ошибка обновления профиля');
    }
  };

  const handleChangePassword = async (e: FormEvent) => {
    e.preventDefault();
    try {
      await apiFetch('/api/profile/password', {
        method: 'POST',
        body: JSON.stringify({ currentPassword, newPassword }),
      });
      setCurrentPassword('');
      setNewPassword('');
      flash('Пароль успешно изменён');
    } catch (err) {
      setErrorMsg(err instanceof Error ? err.message : 'Ошибка смены пароля');
    }
  };

  const TABS: { id: CabinetTab; label: string; count?: number }[] = [
    { id: 'products', label: 'Продукция', count: products.length },
    { id: 'news', label: 'Новости', count: news.length },
    { id: 'vacancies', label: 'Вакансии', count: vacancies.length },
    { id: 'awards', label: 'Награды', count: awards.length },
    { id: 'inquiries', label: 'Заявки', count: inquiries.length },
    { id: 'profile', label: 'Профиль' },
  ];

  return (
    <div>
      <PageBanner
        title="Личный кабинет"
        subtitle={`Вы вошли как ${user.name} (${user.username}).`}
        crumbs={[{ label: 'Кабинет' }]}
      />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        {/* Top Cabinet Controls */}
        <div className="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-[#E5DDD3] mb-8">
          <div className="flex flex-wrap items-center gap-1.5" role="tablist" aria-label="Разделы кабинета">
            {TABS.map((t) => (
              <button
                key={t.id}
                type="button"
                role="tab"
                aria-selected={tab === t.id}
                onClick={() => {
                  setTab(t.id);
                  setNotice(null);
                  setErrorMsg(null);
                }}
                className={`px-4 py-2 text-sm font-medium rounded-md transition-colors whitespace-nowrap shrink-0 ${
                  tab === t.id
                    ? 'bg-[#1F1915] text-white'
                    : 'bg-[#F3EFE8] text-[#5C534A] hover:text-[#1F1915]'
                }`}
              >
                {t.label}
                {t.count !== undefined ? ` (${t.count})` : ''}
              </button>
            ))}
          </div>

          <button
            type="button"
            onClick={handleLogout}
            className="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-[#D4C7B8] bg-white text-sm font-medium text-[#1F1915] hover:bg-[#FAF8F5] transition-colors whitespace-nowrap shrink-0"
          >
            <LogOut className="w-4 h-4" aria-hidden="true" />
            Выйти
          </button>
        </div>

        {notice && (
          <div
            role="status"
            className="mb-6 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-sm text-emerald-900"
          >
            {notice}
          </div>
        )}
        {errorMsg && (
          <div
            role="alert"
            className="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-sm text-red-800"
          >
            {errorMsg}
          </div>
        )}

        {/* TAB: PRODUCTS */}
        {tab === 'products' && (
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <form
              onSubmit={handleCreateProduct}
              className="lg:col-span-4 bg-white border border-[#E5DDD3] rounded-xl p-6 space-y-4"
            >
              <h2 className="font-display text-xl font-semibold text-[#1F1915]">
                Добавить продукцию
              </h2>

              <div>
                <label htmlFor="cab-prod-name" className="block text-xs font-medium text-[#5C534A] mb-1">
                  Полное наименование
                </label>
                <input
                  id="cab-prod-name"
                  type="text"
                  value={prodName}
                  onChange={(e) => setProdName(e.target.value)}
                  placeholder="Хлеб «Ржаной» подовый"
                  className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md"
                />
              </div>

              <div>
                <label htmlFor="cab-prod-short" className="block text-xs font-medium text-[#5C534A] mb-1">
                  Краткое название (до 35 символов)
                </label>
                <input
                  id="cab-prod-short"
                  type="text"
                  value={prodShortName}
                  onChange={(e) => setProdShortName(e.target.value)}
                  placeholder="Хлеб Ржаной"
                  className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md"
                />
              </div>

              <div className="grid grid-cols-2 gap-3">
                <div>
                  <label htmlFor="cab-prod-price" className="block text-xs font-medium text-[#5C534A] mb-1">
                    Цена (₽)
                  </label>
                  <input
                    id="cab-prod-price"
                    type="number"
                    min="1"
                    step="0.5"
                    value={prodPrice}
                    onChange={(e) => setProdPrice(e.target.value)}
                    placeholder="58"
                    className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md tabular-nums"
                  />
                </div>
                <div>
                  <label htmlFor="cab-prod-weight" className="block text-xs font-medium text-[#5C534A] mb-1">
                    Вес (г)
                  </label>
                  <input
                    id="cab-prod-weight"
                    type="number"
                    min="10"
                    value={prodWeight}
                    onChange={(e) => setProdWeight(e.target.value)}
                    placeholder="500"
                    className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md tabular-nums"
                  />
                </div>
              </div>

              <div className="grid grid-cols-2 gap-3">
                <div>
                  <label htmlFor="cab-prod-type" className="block text-xs font-medium text-[#5C534A] mb-1">
                    Категория
                  </label>
                  <select
                    id="cab-prod-type"
                    value={prodType}
                    onChange={(e) => setProdType(e.target.value as ProductCategory)}
                    className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md"
                  >
                    {PRODUCT_CATEGORIES.map((c) => (
                      <option key={c} value={c}>
                        {c}
                      </option>
                    ))}
                  </select>
                </div>
                <div>
                  <label htmlFor="cab-prod-img" className="block text-xs font-medium text-[#5C534A] mb-1">
                    Изображение
                  </label>
                  <select
                    id="cab-prod-img"
                    value={prodImage}
                    onChange={(e) => setProdImage(e.target.value)}
                    className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md"
                  >
                    {IMAGE_PRESETS.map((p) => (
                      <option key={p.value} value={p.value}>
                        {p.label}
                      </option>
                    ))}
                  </select>
                </div>
              </div>

              <div>
                <label htmlFor="cab-prod-desc" className="block text-xs font-medium text-[#5C534A] mb-1">
                  Описание
                </label>
                <textarea
                  id="cab-prod-desc"
                  rows={3}
                  value={prodDesc}
                  onChange={(e) => setProdDesc(e.target.value)}
                  placeholder="Состав и особенности выпечки..."
                  className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md"
                />
              </div>

              <div className="flex items-center gap-5 pt-1">
                <label className="flex items-center gap-2 text-sm cursor-pointer">
                  <input
                    type="checkbox"
                    checked={prodNew}
                    onChange={(e) => setProdNew(e.target.checked)}
                    className="accent-[#B82D25]"
                  />
                  Новинка
                </label>
                <label className="flex items-center gap-2 text-sm cursor-pointer">
                  <input
                    type="checkbox"
                    checked={prodRecommend}
                    onChange={(e) => setProdRecommend(e.target.checked)}
                    className="accent-[#B82D25]"
                  />
                  Рекомендуем
                </label>
              </div>

              <button
                type="submit"
                className="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-md bg-[#B82D25] text-white text-sm font-medium hover:bg-[#93211A]"
              >
                <Plus className="w-4 h-4" aria-hidden="true" />
                Сохранить изделие
              </button>
            </form>

            <div className="lg:col-span-8 bg-white border border-[#E5DDD3] rounded-xl overflow-hidden">
              <div className="overflow-x-auto">
                <table className="w-full text-left text-sm">
                  <thead className="bg-[#F3EFE8] border-b border-[#E5DDD3] text-xs text-[#5C534A]">
                    <tr>
                      <th className="py-3 px-4 font-semibold">Изделие</th>
                      <th className="py-3 px-4 font-semibold">Категория</th>
                      <th className="py-3 px-4 font-semibold text-right">Цена / Вес</th>
                      <th className="py-3 px-4 font-semibold">Статус</th>
                      <th className="py-3 px-4 font-semibold text-right">Действия</th>
                    </tr>
                  </thead>
                  <tbody className="divide-y divide-[#EFE8DF]">
                    {products.map((p) => (
                      <tr key={p.id} className="hover:bg-[#FAF8F5]">
                        <td className="py-3 px-4 font-medium text-[#1F1915]">{p.shortName}</td>
                        <td className="py-3 px-4 text-[#5C534A]">{p.type}</td>
                        <td className="py-3 px-4 text-right tabular-nums whitespace-nowrap">
                          <span className="font-semibold text-[#1F1915]">{formatRub(p.price)}</span>
                          <span className="text-[#786D62]"> · {formatWeight(p.weight)}</span>
                        </td>
                        <td className="py-3 px-4 whitespace-nowrap">
                          <div className="flex items-center gap-2 text-xs">
                            <button
                              type="button"
                              onClick={() => toggleProductField(p, 'published')}
                              className={`underline underline-offset-2 ${
                                p.published ? 'text-emerald-700 font-medium' : 'text-[#786D62]'
                              }`}
                            >
                              {p.published ? 'Опубликовано' : 'Скрыто'}
                            </button>
                            <span aria-hidden="true">·</span>
                            <button
                              type="button"
                              onClick={() => toggleProductField(p, 'isNew')}
                              className={`underline underline-offset-2 ${
                                p.isNew ? 'text-[#B82D25] font-medium' : 'text-[#786D62]'
                              }`}
                            >
                              {p.isNew ? 'Новинка' : 'Обычный'}
                            </button>
                          </div>
                        </td>
                        <td className="py-3 px-4 text-right">
                          <button
                            type="button"
                            onClick={() => deleteProduct(p)}
                            aria-label={`Удалить «${p.shortName}»`}
                            className="inline-flex items-center justify-center w-8 h-8 rounded-md text-[#786D62] hover:text-red-700 hover:bg-red-50 transition-colors"
                          >
                            <Trash2 className="w-4 h-4" />
                          </button>
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        )}

        {/* TAB: NEWS */}
        {tab === 'news' && (
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <form
              onSubmit={handleCreateNews}
              className="lg:col-span-5 bg-white border border-[#E5DDD3] rounded-xl p-6 space-y-4"
            >
              <h2 className="font-display text-xl font-semibold text-[#1F1915]">
                Опубликовать новость
              </h2>
              <div>
                <label htmlFor="cab-news-title" className="block text-xs font-medium text-[#5C534A] mb-1">
                  Заголовок
                </label>
                <input
                  id="cab-news-title"
                  type="text"
                  value={newsTitle}
                  onChange={(e) => setNewsTitle(e.target.value)}
                  placeholder="Запуск новой линейки выпечки"
                  className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md"
                />
              </div>
              <div>
                <label htmlFor="cab-news-img" className="block text-xs font-medium text-[#5C534A] mb-1">
                  Фотография
                </label>
                <select
                  id="cab-news-img"
                  value={newsImage}
                  onChange={(e) => setNewsImage(e.target.value)}
                  className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md"
                >
                  {IMAGE_PRESETS.map((p) => (
                    <option key={p.value} value={p.value}>
                      {p.label}
                    </option>
                  ))}
                </select>
              </div>
              <div>
                <label htmlFor="cab-news-desc" className="block text-xs font-medium text-[#5C534A] mb-1">
                  Текст новости
                </label>
                <textarea
                  id="cab-news-desc"
                  rows={5}
                  value={newsDesc}
                  onChange={(e) => setNewsDesc(e.target.value)}
                  placeholder="Подробности события..."
                  className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md"
                />
              </div>
              <button
                type="submit"
                className="w-full py-2.5 px-4 rounded-md bg-[#B82D25] text-white text-sm font-medium hover:bg-[#93211A]"
              >
                Опубликовать
              </button>
            </form>

            <div className="lg:col-span-7 bg-white border border-[#E5DDD3] rounded-xl divide-y divide-[#EFE8DF]">
              {news.map((item) => (
                <div key={item.id} className="p-5 flex items-start justify-between gap-4">
                  <div>
                    <time className="text-xs text-[#786D62] tabular-nums">
                      {formatRuDate(item.createdAt)}
                    </time>
                    <h3 className="font-sans text-base font-semibold text-[#1F1915] mt-0.5">
                      {item.title}
                    </h3>
                    <p className="text-sm text-[#5C534A] line-clamp-2 mt-1">{item.description}</p>
                  </div>
                  <button
                    type="button"
                    onClick={() => deleteNews(item)}
                    aria-label={`Удалить новость «${item.title}»`}
                    className="w-9 h-9 rounded-md inline-flex items-center justify-center text-[#786D62] hover:text-red-700 hover:bg-red-50 shrink-0"
                  >
                    <Trash2 className="w-4 h-4" />
                  </button>
                </div>
              ))}
            </div>
          </div>
        )}

        {/* TAB: VACANCIES */}
        {tab === 'vacancies' && (
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <form
              onSubmit={handleCreateVacancy}
              className="lg:col-span-5 bg-white border border-[#E5DDD3] rounded-xl p-6 space-y-4"
            >
              <h2 className="font-display text-xl font-semibold text-[#1F1915]">
                Новая вакансия
              </h2>
              <div>
                <label htmlFor="cab-vac-title" className="block text-xs font-medium text-[#5C534A] mb-1">
                  Должность
                </label>
                <input
                  id="cab-vac-title"
                  type="text"
                  value={vacTitle}
                  onChange={(e) => setVacTitle(e.target.value)}
                  placeholder="Кондитер 4 разряда"
                  className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md"
                />
              </div>
              <div className="grid grid-cols-2 gap-3">
                <div>
                  <label htmlFor="cab-vac-dept" className="block text-xs font-medium text-[#5C534A] mb-1">
                    Подразделение
                  </label>
                  <input
                    id="cab-vac-dept"
                    type="text"
                    value={vacDept}
                    onChange={(e) => setVacDept(e.target.value)}
                    className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md"
                  />
                </div>
                <div>
                  <label htmlFor="cab-vac-sched" className="block text-xs font-medium text-[#5C534A] mb-1">
                    График
                  </label>
                  <input
                    id="cab-vac-sched"
                    type="text"
                    value={vacSchedule}
                    onChange={(e) => setVacSchedule(e.target.value)}
                    className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md"
                  />
                </div>
              </div>
              <div>
                <label htmlFor="cab-vac-desc" className="block text-xs font-medium text-[#5C534A] mb-1">
                  Обязанности и условия
                </label>
                <textarea
                  id="cab-vac-desc"
                  rows={4}
                  value={vacDesc}
                  onChange={(e) => setVacDesc(e.target.value)}
                  placeholder="Требования и социальные гарантии..."
                  className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md"
                />
              </div>
              <button
                type="submit"
                className="w-full py-2.5 px-4 rounded-md bg-[#B82D25] text-white text-sm font-medium hover:bg-[#93211A]"
              >
                Добавить вакансию
              </button>
            </form>

            <div className="lg:col-span-7 bg-white border border-[#E5DDD3] rounded-xl divide-y divide-[#EFE8DF]">
              {vacancies.map((v) => (
                <div key={v.id} className="p-5 flex items-start justify-between gap-4">
                  <div>
                    <h3 className="font-sans text-base font-semibold text-[#1F1915]">{v.title}</h3>
                    <p className="text-xs text-[#6B6056] mt-0.5">
                      {v.department} · {v.schedule} ·{' '}
                      <button
                        type="button"
                        onClick={() => toggleVacancyOpen(v)}
                        className={`underline underline-offset-2 ${
                          v.open ? 'text-emerald-700 font-medium' : 'text-[#786D62]'
                        }`}
                      >
                        {v.open ? 'Открыта' : 'Закрыта'}
                      </button>
                    </p>
                  </div>
                  <button
                    type="button"
                    onClick={() => deleteVacancy(v)}
                    aria-label={`Удалить вакансию «${v.title}»`}
                    className="w-9 h-9 rounded-md inline-flex items-center justify-center text-[#786D62] hover:text-red-700 hover:bg-red-50 shrink-0"
                  >
                    <Trash2 className="w-4 h-4" />
                  </button>
                </div>
              ))}
            </div>
          </div>
        )}

        {/* TAB: AWARDS */}
        {tab === 'awards' && (
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <form
              onSubmit={handleCreateAward}
              className="lg:col-span-4 bg-white border border-[#E5DDD3] rounded-xl p-6 space-y-4"
            >
              <h2 className="font-display text-xl font-semibold text-[#1F1915]">
                Добавить награду
              </h2>
              <div>
                <label htmlFor="cab-award-year" className="block text-xs font-medium text-[#5C534A] mb-1">
                  Год
                </label>
                <input
                  id="cab-award-year"
                  type="number"
                  min="1956"
                  max="2030"
                  value={awardYear}
                  onChange={(e) => setAwardYear(e.target.value)}
                  className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md tabular-nums"
                />
              </div>
              <div>
                <label htmlFor="cab-award-desc" className="block text-xs font-medium text-[#5C534A] mb-1">
                  Описание награды или диплома
                </label>
                <textarea
                  id="cab-award-desc"
                  rows={4}
                  value={awardDesc}
                  onChange={(e) => setAwardDesc(e.target.value)}
                  placeholder="Диплом конкурса качества..."
                  className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md"
                />
              </div>
              <button
                type="submit"
                className="w-full py-2.5 px-4 rounded-md bg-[#B82D25] text-white text-sm font-medium hover:bg-[#93211A]"
              >
                Сохранить награду
              </button>
            </form>

            <div className="lg:col-span-8 bg-white border border-[#E5DDD3] rounded-xl divide-y divide-[#EFE8DF]">
              {awards.map((a) => (
                <div key={a.id} className="p-5 flex items-start justify-between gap-4">
                  <div className="flex items-baseline gap-5">
                    <span className="font-display text-xl font-semibold text-[#B82D25] tabular-nums">
                      {a.year}
                    </span>
                    <p className="text-sm text-[#1F1915]">{a.description}</p>
                  </div>
                  <button
                    type="button"
                    onClick={() => deleteAward(a)}
                    aria-label={`Удалить награду ${a.year}`}
                    className="w-9 h-9 rounded-md inline-flex items-center justify-center text-[#786D62] hover:text-red-700 hover:bg-red-50 shrink-0"
                  >
                    <Trash2 className="w-4 h-4" />
                  </button>
                </div>
              ))}
            </div>
          </div>
        )}

        {/* TAB: INQUIRIES */}
        {tab === 'inquiries' && (
          <div className="bg-white border border-[#E5DDD3] rounded-xl divide-y divide-[#EFE8DF]">
            {inquiries.length === 0 ? (
              <p className="p-8 text-sm text-[#5C534A] text-center">Заявок пока нет.</p>
            ) : (
              inquiries.map((inq) => (
                <div key={inq.id} className="p-6">
                  <div className="flex flex-wrap items-baseline justify-between gap-2 mb-2">
                    <div className="text-xs text-[#6B6056]">
                      <span className="font-semibold text-[#8C5319]">
                        {inq.kind === 'product' ? 'Заявка по продукции' : 'Отзыв с сайта'}
                      </span>
                      <span aria-hidden="true"> · </span>
                      <span>{inq.name}</span>
                      <span aria-hidden="true"> · </span>
                      <a href={`mailto:${inq.email}`} className="text-[#B82D25] hover:underline">
                        {inq.email}
                      </a>
                    </div>
                    <time className="text-xs text-[#786D62] tabular-nums">
                      {formatRuDate(inq.createdAt)}
                    </time>
                  </div>
                  <h3 className="font-sans text-base font-semibold text-[#1F1915] mb-1">
                    {inq.subject}
                  </h3>
                  <p className="text-sm text-[#3D352E] leading-relaxed">{inq.body}</p>
                </div>
              ))
            )}
          </div>
        )}

        {/* TAB: PROFILE */}
        {tab === 'profile' && (
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <form
              onSubmit={handleUpdateProfile}
              className="bg-white border border-[#E5DDD3] rounded-xl p-6 space-y-4"
            >
              <h2 className="font-display text-xl font-semibold text-[#1F1915]">
                Параметры профиля
              </h2>
              <div>
                <label htmlFor="prof-name" className="block text-xs font-medium text-[#5C534A] mb-1">
                  Имя
                </label>
                <input
                  id="prof-name"
                  type="text"
                  value={profileName}
                  onChange={(e) => setProfileName(e.target.value)}
                  className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md"
                />
              </div>
              <div>
                <label htmlFor="prof-email" className="block text-xs font-medium text-[#5C534A] mb-1">
                  E-mail
                </label>
                <input
                  id="prof-email"
                  type="email"
                  value={profileEmail}
                  onChange={(e) => setProfileEmail(e.target.value)}
                  className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md"
                />
              </div>
              <div>
                <label htmlFor="prof-phone" className="block text-xs font-medium text-[#5C534A] mb-1">
                  Телефон
                </label>
                <input
                  id="prof-phone"
                  type="text"
                  value={profilePhone}
                  onChange={(e) => setProfilePhone(e.target.value)}
                  className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md tabular-nums"
                />
              </div>
              <button
                type="submit"
                className="px-5 py-2.5 rounded-md bg-[#B82D25] text-white text-sm font-medium hover:bg-[#93211A]"
              >
                Сохранить профиль
              </button>
            </form>

            <form
              onSubmit={handleChangePassword}
              className="bg-white border border-[#E5DDD3] rounded-xl p-6 space-y-4"
            >
              <h2 className="font-display text-xl font-semibold text-[#1F1915]">
                Изменить пароль
              </h2>
              <p className="text-xs text-[#6B6056]">
                Пароль от сайта и корпоративного почтового ящика различаются. По вопросам
                почтового ящика обращайтесь на support@kambread.ru.
              </p>
              <div>
                <label htmlFor="pass-cur" className="block text-xs font-medium text-[#5C534A] mb-1">
                  Текущий пароль
                </label>
                <input
                  id="pass-cur"
                  type="password"
                  value={currentPassword}
                  onChange={(e) => setCurrentPassword(e.target.value)}
                  className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md"
                />
              </div>
              <div>
                <label htmlFor="pass-new" className="block text-xs font-medium text-[#5C534A] mb-1">
                  Новый пароль (от 6 символов)
                </label>
                <input
                  id="pass-new"
                  type="password"
                  value={newPassword}
                  onChange={(e) => setNewPassword(e.target.value)}
                  className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md"
                />
              </div>
              <button
                type="submit"
                className="px-5 py-2.5 rounded-md bg-[#1F1915] text-white text-sm font-medium hover:bg-[#362C25]"
              >
                Обновить пароль
              </button>
            </form>
          </div>
        )}
      </div>
    </div>
  );
}
