import { useEffect, useState, type FormEvent } from 'react';
import { Link, useParams } from 'react-router-dom';
import { ArrowLeft, CheckCircle2 } from 'lucide-react';
import { apiFetch } from '../lib/api';
import { formatRub, formatWeight, validateInquiryForm } from '../lib/catalog';
import { useAuth } from '../context/AuthContext';
import type { Product } from '../lib/types';
import { PageBanner } from '../components/Layout';
import { SafeImage } from '../components/SafeImage';

export function ProductDetailPage() {
  const { id } = useParams();
  const { user } = useAuth();
  const [product, setProduct] = useState<Product | null>(null);
  const [related, setRelated] = useState<Product[]>([]);
  const [loading, setLoading] = useState(true);
  const [notFound, setNotFound] = useState(false);

  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [text, setText] = useState('');
  const [errors, setErrors] = useState<Record<string, string>>({});
  const [submitting, setSubmitting] = useState(false);
  const [sentMessage, setSentMessage] = useState<string | null>(null);
  const [submitError, setSubmitError] = useState<string | null>(null);

  useEffect(() => {
    if (user) {
      setName((prev) => prev || user.name);
      setEmail((prev) => prev || user.email);
    }
  }, [user]);

  useEffect(() => {
    let active = true;
    setLoading(true);
    setNotFound(false);
    setSentMessage(null);

    Promise.all([
      apiFetch<{ item: Product }>(`/api/products/${id}`),
      apiFetch<{ items: Product[] }>('/api/products'),
    ])
      .then(([itemRes, allRes]) => {
        if (!active) return;
        setProduct(itemRes.item);
        setRelated(
          allRes.items
            .filter((p) => p.id !== itemRes.item.id && (p.isNew || p.type === itemRes.item.type))
            .slice(0, 4),
        );
      })
      .catch(() => {
        if (active) setNotFound(true);
      })
      .finally(() => {
        if (active) setLoading(false);
      });

    return () => {
      active = false;
    };
  }, [id]);

  const handleSubmit = async (e: FormEvent) => {
    e.preventDefault();
    const validation = validateInquiryForm({ name, email, text });
    setErrors(validation);
    setSubmitError(null);
    if (Object.keys(validation).length > 0 || !product) return;

    setSubmitting(true);
    try {
      const res = await apiFetch<{ message: string }>('/api/inquiries', {
        method: 'POST',
        body: JSON.stringify({
          productId: product.id,
          name,
          email,
          text,
        }),
      });
      setSentMessage(res.message);
      setText('');
    } catch (err) {
      setSubmitError(err instanceof Error ? err.message : 'Не удалось отправить заявку');
    } finally {
      setSubmitting(false);
    }
  };

  if (loading) {
    return (
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div className="h-96 rounded-xl bg-[#EFE9E0] animate-pulse" />
      </div>
    );
  }

  if (notFound || !product) {
    return (
      <div className="max-w-3xl mx-auto px-4 py-20 text-center">
        <h1 className="font-display text-3xl text-[#1F1915] mb-3">Продукция не найдена</h1>
        <p className="text-sm text-[#5C534A] mb-6">
          Возможно, карточка товара была удалена или снята с публикации.
        </p>
        <Link
          to="/products"
          className="inline-flex items-center gap-2 px-5 py-2.5 rounded-md bg-[#B82D25] text-white text-sm font-medium"
        >
          <ArrowLeft className="w-4 h-4" />
          Вернуться в каталог
        </Link>
      </div>
    );
  }

  return (
    <div>
      <PageBanner
        title={product.shortName}
        crumbs={[
          { label: 'Продукция', to: '/products' },
          { label: product.shortName },
        ]}
      />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
          {/* Left: Product Image & Full Description */}
          <div className="lg:col-span-7 space-y-8">
            <div className="aspect-[4/3] rounded-xl overflow-hidden border border-[#E5DDD3] bg-[#F3EFE8]">
              <SafeImage
                src={product.image}
                alt={product.name}
                className="w-full h-full object-cover"
              />
            </div>

            <div className="bg-white border border-[#E5DDD3] rounded-xl p-6 sm:p-8">
              <h2 className="font-display text-2xl font-semibold text-[#1F1915] mb-4">
                Описание изделия
              </h2>
              <p className="text-base text-[#3D352E] leading-relaxed whitespace-pre-line">
                {product.description}
              </p>
              <p className="mt-5 pt-5 border-t border-[#EFE8DF] text-xs text-[#6B6056]">
                Продукция сертифицирована и декларирована в соответствии с требованиями
                Технического регламента Таможенного союза (ТР ТС). Контроль качества выполняется
                собственной лабораторией комбината.
              </p>
            </div>
          </div>

          {/* Right: Contiguous Spec & Enquiry Module */}
          <div className="lg:col-span-5 space-y-6">
            <div className="bg-white border border-[#E5DDD3] rounded-xl p-6 sm:p-7">
              <div className="flex items-center gap-2 text-xs text-[#5C534A] mb-2">
                <span>{product.type}</span>
                {product.isNew && (
                  <>
                    <span aria-hidden="true">·</span>
                    <span className="font-semibold text-[#B82D25]">Новинка</span>
                  </>
                )}
                {product.isRecommend && (
                  <>
                    <span aria-hidden="true">·</span>
                    <span className="font-medium text-[#8C5319]">Рекомендуем</span>
                  </>
                )}
              </div>

              <h2 className="font-display text-2xl font-semibold text-[#1F1915] leading-snug mb-6">
                {product.name}
              </h2>

              <dl className="grid grid-cols-2 gap-4 py-5 border-y border-[#EFE8DF] mb-6">
                <div>
                  <dt className="text-xs text-[#6B6056] mb-1">Ориентировочная цена</dt>
                  <dd className="text-2xl font-semibold text-[#B82D25] tabular-nums">
                    {formatRub(product.price)}
                  </dd>
                </div>
                <div>
                  <dt className="text-xs text-[#6B6056] mb-1">Масса нетто</dt>
                  <dd className="text-2xl font-semibold text-[#1F1915] tabular-nums">
                    {formatWeight(product.weight)}
                  </dd>
                </div>
              </dl>

              <h3 className="font-sans text-base font-semibold text-[#1F1915] mb-3">
                Отправить заявку в отдел маркетинга
              </h3>

              {sentMessage ? (
                <div
                  role="status"
                  className="p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm flex items-start gap-3"
                >
                  <CheckCircle2 className="w-5 h-5 text-emerald-700 shrink-0 mt-0.5" />
                  <div>
                    <p className="font-medium">{sentMessage}</p>
                    <p className="text-xs text-emerald-800 mt-1">
                      Менеджер свяжется с вами в рабочее время по указанному e-mail.
                    </p>
                  </div>
                </div>
              ) : (
                <form onSubmit={handleSubmit} noValidate className="space-y-4">
                  <div>
                    <label
                      htmlFor="inquiry-name"
                      className="block text-xs font-medium text-[#5C534A] mb-1"
                    >
                      Ваше имя
                    </label>
                    <input
                      id="inquiry-name"
                      type="text"
                      value={name}
                      onChange={(e) => setName(e.target.value)}
                      placeholder="Иван Петров"
                      className="w-full px-3.5 py-2.5 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md text-[#1F1915] focus:outline-none focus:ring-2 focus:ring-[#B82D25]"
                    />
                    {errors.name && (
                      <p className="mt-1 text-xs text-red-700">{errors.name}</p>
                    )}
                  </div>

                  <div>
                    <label
                      htmlFor="inquiry-email"
                      className="block text-xs font-medium text-[#5C534A] mb-1"
                    >
                      Ваш e-mail
                    </label>
                    <input
                      id="inquiry-email"
                      type="email"
                      value={email}
                      onChange={(e) => setEmail(e.target.value)}
                      placeholder="name@company.ru"
                      className="w-full px-3.5 py-2.5 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md text-[#1F1915] focus:outline-none focus:ring-2 focus:ring-[#B82D25]"
                    />
                    {errors.email && (
                      <p className="mt-1 text-xs text-red-700">{errors.email}</p>
                    )}
                  </div>

                  <div>
                    <label
                      htmlFor="inquiry-text"
                      className="block text-xs font-medium text-[#5C534A] mb-1"
                    >
                      Текст заявки
                    </label>
                    <textarea
                      id="inquiry-text"
                      rows={4}
                      value={text}
                      onChange={(e) => setText(e.target.value)}
                      placeholder="Укажите интересующий объём и желаемый график поставки..."
                      className="w-full px-3.5 py-2.5 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md text-[#1F1915] focus:outline-none focus:ring-2 focus:ring-[#B82D25]"
                    />
                    {errors.text && (
                      <p className="mt-1 text-xs text-red-700">{errors.text}</p>
                    )}
                  </div>

                  {submitError && (
                    <p className="text-xs text-red-700 bg-red-50 border border-red-200 rounded-md p-2.5">
                      {submitError}
                    </p>
                  )}

                  <button
                    type="submit"
                    disabled={submitting}
                    className="w-full py-3 px-4 rounded-md bg-[#B82D25] text-white text-sm font-medium hover:bg-[#93211A] disabled:opacity-60 transition-colors"
                  >
                    {submitting ? 'Отправка...' : 'Отправить заявку'}
                  </button>
                </form>
              )}
            </div>

            {related.length > 0 && (
              <div className="bg-white border border-[#E5DDD3] rounded-xl p-6">
                <h3 className="font-sans text-sm font-semibold text-[#1F1915] mb-4">
                  Также рекомендуем
                </h3>
                <div className="divide-y divide-[#EFE8DF]">
                  {related.map((item) => (
                    <Link
                      key={item.id}
                      to={`/products/${item.id}`}
                      className="py-3 first:pt-0 last:pb-0 flex items-center justify-between gap-3 group"
                    >
                      <div className="flex items-center gap-3 min-w-0">
                        <div className="w-12 h-12 rounded-lg overflow-hidden bg-[#F3EFE8] shrink-0">
                          <SafeImage
                            src={item.image}
                            alt={item.shortName}
                            className="w-full h-full object-cover"
                          />
                        </div>
                        <span className="text-sm font-medium text-[#1F1915] group-hover:text-[#B82D25] truncate">
                          {item.shortName}
                        </span>
                      </div>
                      <span className="text-sm font-semibold text-[#8C5319] tabular-nums shrink-0">
                        {formatRub(item.price)}
                      </span>
                    </Link>
                  ))}
                </div>
              </div>
            )}
          </div>
        </div>
      </div>
    </div>
  );
}
