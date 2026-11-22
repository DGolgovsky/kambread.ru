import { useEffect, useMemo, useState } from 'react';
import { Link, useSearchParams } from 'react-router-dom';
import { RotateCcw, Search } from 'lucide-react';
import { apiFetch } from '../lib/api';
import {
  PRICE_RANGES,
  filterProducts,
  formatRub,
  paginateItems,
} from '../lib/catalog';
import { PRODUCT_CATEGORIES, type Product } from '../lib/types';
import { PageBanner } from '../components/Layout';
import { ProductCard } from '../components/ProductCard';
import { SafeImage } from '../components/SafeImage';

const PAGE_SIZE = 6;

export function ProductsPage() {
  const [searchParams, setSearchParams] = useSearchParams();
  const [allProducts, setAllProducts] = useState<Product[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  const [query, setQuery] = useState(() => searchParams.get('q') ?? '');
  const [category, setCategory] = useState(() => searchParams.get('type') ?? '');
  const [priceRange, setPriceRange] = useState(() => searchParams.get('price') ?? '');
  const [newOnly, setNewOnly] = useState(() => searchParams.get('new') === '1');
  const [currentPage, setCurrentPage] = useState(
    () => Number(searchParams.get('page') ?? '1') || 1,
  );

  useEffect(() => {
    let active = true;
    setLoading(true);
    apiFetch<{ items: Product[] }>('/api/products')
      .then((res) => {
        if (active) {
          setAllProducts(res.items);
          setError(null);
        }
      })
      .catch((err: Error) => {
        if (active) setError(err.message);
      })
      .finally(() => {
        if (active) setLoading(false);
      });
    return () => {
      active = false;
    };
  }, []);

  useEffect(() => {
    const next = new URLSearchParams();
    if (query) next.set('q', query);
    if (category) next.set('type', category);
    if (priceRange) next.set('price', priceRange);
    if (newOnly) next.set('new', '1');
    if (currentPage > 1) next.set('page', String(currentPage));
    setSearchParams(next, { replace: true });
  }, [query, category, priceRange, newOnly, currentPage, setSearchParams]);

  const resetFilters = () => {
    setQuery('');
    setCategory('');
    setPriceRange('');
    setNewOnly(false);
    setCurrentPage(1);
  };

  const filtered = useMemo(
    () => filterProducts(allProducts, { query, category, priceRange, newOnly }),
    [allProducts, query, category, priceRange, newOnly],
  );

  const paged = useMemo(
    () => paginateItems(filtered, currentPage, PAGE_SIZE),
    [filtered, currentPage],
  );

  const hotNewProducts = useMemo(
    () => allProducts.filter((p) => p.isNew).slice(0, 4),
    [allProducts],
  );

  const hasActiveFilters = Boolean(query || category || priceRange || newOnly);

  return (
    <div>
      <PageBanner
        title="Каталог продукции"
        subtitle="Более 75 видов хлеба, батонов, сдобы, баранок и кондитерских изделий собственного производства."
        crumbs={[{ label: 'Продукция' }]}
      />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-8">
          {/* Sidebar Filters & Hot New Widget */}
          <aside className="lg:col-span-3 space-y-8">
            <div className="bg-white border border-[#E5DDD3] rounded-xl p-5">
              <div className="flex items-center justify-between gap-2 mb-5">
                <h2 className="font-sans text-base font-semibold text-[#1F1915]">
                  Параметры поиска
                </h2>
                {hasActiveFilters && (
                  <button
                    type="button"
                    onClick={resetFilters}
                    className="inline-flex items-center gap-1 text-xs font-medium text-[#B82D25] hover:underline"
                  >
                    <RotateCcw className="w-3.5 h-3.5" aria-hidden="true" />
                    Сбросить
                  </button>
                )}
              </div>

              <div className="space-y-4">
                <div>
                  <label
                    htmlFor="catalog-search"
                    className="block text-xs font-medium text-[#5C534A] mb-1.5"
                  >
                    Название или состав
                  </label>
                  <div className="relative">
                    <Search
                      className="w-4 h-4 text-[#8C7F73] absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"
                      aria-hidden="true"
                    />
                    <input
                      id="catalog-search"
                      type="search"
                      value={query}
                      onChange={(e) => {
                        setQuery(e.target.value);
                        setCurrentPage(1);
                      }}
                      placeholder="Например: Бородинский"
                      className="w-full pl-9 pr-3 py-2.5 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md text-[#1F1915] placeholder:text-[#968A7E] focus:outline-none focus:ring-2 focus:ring-[#B82D25]"
                    />
                  </div>
                </div>

                <div>
                  <label
                    htmlFor="catalog-category"
                    className="block text-xs font-medium text-[#5C534A] mb-1.5"
                  >
                    Вид продукции
                  </label>
                  <select
                    id="catalog-category"
                    value={category}
                    onChange={(e) => {
                      setCategory(e.target.value);
                      setCurrentPage(1);
                    }}
                    className="w-full px-3 py-2.5 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md text-[#1F1915] focus:outline-none focus:ring-2 focus:ring-[#B82D25]"
                  >
                    <option value="">Все категории</option>
                    {PRODUCT_CATEGORIES.map((cat) => (
                      <option key={cat} value={cat}>
                        {cat}
                      </option>
                    ))}
                  </select>
                </div>

                <div>
                  <label
                    htmlFor="catalog-price"
                    className="block text-xs font-medium text-[#5C534A] mb-1.5"
                  >
                    Ценовой диапазон
                  </label>
                  <select
                    id="catalog-price"
                    value={priceRange}
                    onChange={(e) => {
                      setPriceRange(e.target.value);
                      setCurrentPage(1);
                    }}
                    className="w-full px-3 py-2.5 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md text-[#1F1915] focus:outline-none focus:ring-2 focus:ring-[#B82D25]"
                  >
                    <option value="">Любая цена</option>
                    {PRICE_RANGES.map((r) => (
                      <option key={r.value} value={r.value}>
                        {r.label}
                      </option>
                    ))}
                  </select>
                </div>

                <label
                  htmlFor="catalog-new-only"
                  className="flex items-center gap-2.5 pt-1 cursor-pointer select-none"
                >
                  <input
                    id="catalog-new-only"
                    type="checkbox"
                    checked={newOnly}
                    onChange={(e) => {
                      setNewOnly(e.target.checked);
                      setCurrentPage(1);
                    }}
                    className="w-4 h-4 rounded border-[#CFC3B4] accent-[#B82D25]"
                  />
                  <span className="text-sm text-[#1F1915]">Только новинки</span>
                </label>
              </div>
            </div>

            {hotNewProducts.length > 0 && (
              <div className="bg-white border border-[#E5DDD3] rounded-xl p-5 hidden lg:block">
                <h2 className="font-sans text-base font-semibold text-[#1F1915] mb-4">
                  Горячие новинки
                </h2>
                <div className="divide-y divide-[#EFE8DF]">
                  {hotNewProducts.map((item) => (
                    <Link
                      key={item.id}
                      to={`/products/${item.id}`}
                      className="py-3 first:pt-0 last:pb-0 flex items-center gap-3 group"
                    >
                      <div className="w-14 h-14 rounded-lg overflow-hidden bg-[#F3EFE8] border border-[#E5DDD3] shrink-0">
                        <SafeImage
                          src={item.image}
                          alt={item.shortName}
                          className="w-full h-full object-cover"
                        />
                      </div>
                      <div className="min-w-0">
                        <p className="text-sm font-medium text-[#1F1915] group-hover:text-[#B82D25] truncate transition-colors">
                          {item.shortName}
                        </p>
                        <p className="text-xs font-semibold text-[#8C5319] tabular-nums mt-0.5">
                          {formatRub(item.price)}
                        </p>
                      </div>
                    </Link>
                  ))}
                </div>
              </div>
            )}
          </aside>

          {/* Product Grid */}
          <div className="lg:col-span-9">
            <div className="flex flex-wrap items-center justify-between gap-4 mb-6">
              <p className="text-sm text-[#5C534A] tabular-nums" data-testid="catalog-count">
                Найдено позиций: <strong className="text-[#1F1915]">{filtered.length}</strong>
              </p>

              <div className="flex items-center gap-1.5 overflow-x-auto pb-1">
                <button
                  type="button"
                  onClick={() => {
                    setCategory('');
                    setCurrentPage(1);
                  }}
                  className={`px-3 py-1.5 text-xs font-medium rounded-md transition-colors whitespace-nowrap shrink-0 ${
                    category === ''
                      ? 'bg-[#1F1915] text-white'
                      : 'bg-[#F3EFE8] text-[#5C534A] hover:text-[#1F1915]'
                  }`}
                >
                  Все
                </button>
                {PRODUCT_CATEGORIES.map((cat) => (
                  <button
                    key={cat}
                    type="button"
                    onClick={() => {
                      setCategory(cat);
                      setCurrentPage(1);
                    }}
                    className={`px-3 py-1.5 text-xs font-medium rounded-md transition-colors whitespace-nowrap shrink-0 ${
                      category === cat
                        ? 'bg-[#1F1915] text-white'
                        : 'bg-[#F3EFE8] text-[#5C534A] hover:text-[#1F1915]'
                    }`}
                  >
                    {cat}
                  </button>
                ))}
              </div>
            </div>

            {error && (
              <div className="p-5 rounded-xl bg-red-50 border border-red-200 text-sm text-red-800 mb-6">
                Не удалось загрузить каталог: {error}
              </div>
            )}

            {loading ? (
              <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {Array.from({ length: 6 }).map((_, idx) => (
                  <div
                    key={idx}
                    className="h-80 rounded-xl bg-[#EFE9E0] border border-[#E5DDD3] animate-pulse"
                  />
                ))}
              </div>
            ) : paged.items.length === 0 ? (
              <div className="bg-white border border-[#E5DDD3] rounded-xl p-12 text-center">
                <h3 className="font-display text-2xl text-[#1F1915] mb-2">
                  По выбранным параметрам ничего не найдено
                </h3>
                <p className="text-sm text-[#5C534A] mb-6">
                  Попробуйте изменить запрос или сбросить фильтры каталога.
                </p>
                <button
                  type="button"
                  onClick={resetFilters}
                  className="px-5 py-2.5 rounded-md bg-[#B82D25] text-white text-sm font-medium hover:bg-[#93211A]"
                >
                  Показать всю продукцию
                </button>
              </div>
            ) : (
              <>
                <div
                  data-testid="catalog-grid"
                  className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
                >
                  {paged.items.map((item) => (
                    <ProductCard key={item.id} product={item} />
                  ))}
                </div>

                {paged.totalPages > 1 && (
                  <nav
                    aria-label="Пагинация каталога"
                    className="mt-10 flex items-center justify-center gap-2"
                  >
                    {Array.from({ length: paged.totalPages }, (_, i) => i + 1).map((pageNum) => (
                      <button
                        key={pageNum}
                        type="button"
                        onClick={() => setCurrentPage(pageNum)}
                        aria-current={pageNum === paged.page ? 'page' : undefined}
                        className={`w-10 h-10 rounded-md text-sm font-medium tabular-nums transition-colors ${
                          pageNum === paged.page
                            ? 'bg-[#B82D25] text-white'
                            : 'bg-white border border-[#E5DDD3] text-[#1F1915] hover:bg-[#F3EFE8]'
                        }`}
                      >
                        {pageNum}
                      </button>
                    ))}
                  </nav>
                )}
              </>
            )}
          </div>
        </div>
      </div>
    </div>
  );
}
