import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { ArrowRight, ChevronLeft, ChevronRight } from 'lucide-react';
import { apiFetch } from '../lib/api';
import { formatRuDate } from '../lib/catalog';
import { ADVANTAGES, HERO_SLIDES, PARTNER_LOGOS } from '../lib/seedData';
import type { NewsItem, Product } from '../lib/types';
import { ProductCard } from '../components/ProductCard';
import { SafeImage } from '../components/SafeImage';

export function HomePage() {
  const [slideIdx, setSlideIdx] = useState(0);
  const [featured, setFeatured] = useState<Product[]>([]);
  const [latestNews, setLatestNews] = useState<NewsItem[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    let active = true;
    Promise.all([
      apiFetch<{ items: Product[] }>('/api/products'),
      apiFetch<{ items: NewsItem[] }>('/api/news'),
    ])
      .then(([prodRes, newsRes]) => {
        if (!active) return;
        const prioritized = prodRes.items.filter((p) => p.isNew || p.isRecommend);
        setFeatured((prioritized.length >= 6 ? prioritized : prodRes.items).slice(0, 6));
        setLatestNews(newsRes.items.slice(0, 3));
      })
      .finally(() => {
        if (active) setLoading(false);
      });

    return () => {
      active = false;
    };
  }, []);

  const currentSlide = HERO_SLIDES[slideIdx];

  const handlePrev = () => {
    setSlideIdx((prev) => (prev === 0 ? HERO_SLIDES.length - 1 : prev - 1));
  };

  const handleNext = () => {
    setSlideIdx((prev) => (prev + 1) % HERO_SLIDES.length);
  };

  return (
    <div>
      {/* Section 1: Storefront Split Hero */}
      <section className="bg-[#F3EFE8] border-b border-[#E5DDD3]">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-stretch">
            <div className="lg:col-span-5 flex flex-col justify-between py-2">
              <div>
                <p className="text-sm font-medium text-[#8C5319] mb-4">
                  г. Камышин, ул. Ленина, 4 · Основан в 1956 году
                </p>
                <h1 className="font-display text-4xl sm:text-5xl font-semibold text-[#1F1915] leading-[1.12] tracking-tight text-balance mb-5">
                  {currentSlide.title}
                </h1>
                <p className="text-base text-[#5C534A] leading-relaxed max-w-prose mb-8">
                  {currentSlide.subtitle}
                </p>

                <div className="flex flex-wrap items-center gap-4">
                  <Link
                    to="/products"
                    className="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-md bg-[#B82D25] text-white text-sm font-medium hover:bg-[#93211A] transition-colors whitespace-nowrap shrink-0 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#B82D25]"
                  >
                    Смотреть каталог
                    <ArrowRight className="w-4 h-4" aria-hidden="true" />
                  </Link>
                  <Link
                    to="/partners"
                    className="inline-flex items-center justify-center px-5 py-3 rounded-md border border-[#D4C7B8] bg-white text-sm font-medium text-[#1F1915] hover:bg-[#FAF8F5] transition-colors whitespace-nowrap shrink-0"
                  >
                    Оптовым партнёрам
                  </Link>
                </div>
              </div>

              <div className="mt-10 pt-6 border-t border-[#E5DDD3] flex items-center justify-between gap-4">
                <div className="flex items-center gap-2" role="tablist" aria-label="Слайды витрины">
                  {HERO_SLIDES.map((slide, index) => (
                    <button
                      key={slide.id}
                      type="button"
                      role="tab"
                      aria-selected={index === slideIdx}
                      aria-label={`Слайд ${index + 1}: ${slide.title}`}
                      onClick={() => setSlideIdx(index)}
                      className={`h-2.5 rounded-full transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#B82D25] ${
                        index === slideIdx
                          ? 'w-8 bg-[#B82D25]'
                          : 'w-2.5 bg-[#CFC3B4] hover:bg-[#8C5319]'
                      }`}
                    />
                  ))}
                </div>
                <div className="flex items-center gap-2">
                  <button
                    type="button"
                    onClick={handlePrev}
                    aria-label="Предыдущий слайд"
                    className="w-10 h-10 rounded-md border border-[#D4C7B8] bg-white text-[#1F1915] hover:bg-[#FAF8F5] inline-flex items-center justify-center transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#B82D25]"
                  >
                    <ChevronLeft className="w-4 h-4" />
                  </button>
                  <button
                    type="button"
                    onClick={handleNext}
                    aria-label="Следующий слайд"
                    className="w-10 h-10 rounded-md border border-[#D4C7B8] bg-white text-[#1F1915] hover:bg-[#FAF8F5] inline-flex items-center justify-center transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#B82D25]"
                  >
                    <ChevronRight className="w-4 h-4" />
                  </button>
                </div>
              </div>
            </div>

            <div className="lg:col-span-7">
              <div className="relative w-full h-72 sm:h-96 lg:h-full min-h-[380px] rounded-xl overflow-hidden border border-[#E5DDD3] bg-[#E8DFD4]">
                <SafeImage
                  src={currentSlide.image}
                  alt={currentSlide.title}
                  className="w-full h-full object-cover"
                />
                <div className="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/75 via-black/35 to-transparent p-6 flex items-end justify-between gap-4">
                  <div className="text-white">
                    <p className="text-xs text-white/80 mb-1 tabular-nums">
                      Приёмная: (84457) 9-64-64 · Отдел маркетинга: (84457) 9-39-84
                    </p>
                    <p className="text-sm font-medium">
                      АО «Камышинский хлебокомбинат»
                    </p>
                  </div>
                  <Link
                    to={`/products/${currentSlide.productId}`}
                    className="text-xs font-medium text-white underline underline-offset-4 hover:text-[#F3EFE8] whitespace-nowrap shrink-0"
                  >
                    Карточка изделия
                  </Link>
                </div>
              </div>
            </div>
          </div>

          {/* Heritage Advantages Strip */}
          <div className="mt-10 pt-8 border-t border-[#E5DDD3] grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-6">
            {ADVANTAGES.map((adv) => (
              <div key={adv.title} className="flex flex-col items-start">
                <img
                  src={adv.image}
                  alt=""
                  aria-hidden="true"
                  className="h-12 w-12 object-contain mb-3 opacity-90"
                />
                <h2 className="font-sans text-sm font-semibold text-[#1F1915] leading-snug mb-1">
                  {adv.title}
                </h2>
                <p className="text-xs text-[#5C534A] leading-relaxed">{adv.detail}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Section 2: Featured Product Collection */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
          <div>
            <p className="text-sm font-medium text-[#8C5319] mb-2">Свежая выпечка ежедневно</p>
            <h2 className="font-display text-3xl sm:text-4xl font-semibold text-[#1F1915] tracking-tight">
              Наша продукция
            </h2>
          </div>
          <Link
            to="/products"
            className="inline-flex items-center gap-1.5 text-sm font-medium text-[#B82D25] hover:text-[#93211A] whitespace-nowrap shrink-0"
          >
            Весь каталог продукции
            <ArrowRight className="w-4 h-4" aria-hidden="true" />
          </Link>
        </div>

        {loading ? (
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            {Array.from({ length: 6 }).map((_, i) => (
              <div
                key={i}
                className="h-80 rounded-xl bg-[#EFE9E0] border border-[#E5DDD3] animate-pulse"
              />
            ))}
          </div>
        ) : (
          <div
            data-testid="featured-products-grid"
            className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
          >
            {featured.map((product) => (
              <ProductCard key={product.id} product={product} />
            ))}
          </div>
        )}
      </section>

      {/* Section 3: Company Story & Latest News */}
      <section className="border-y border-[#E5DDD3] bg-white">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <div className="lg:col-span-6">
              <p className="text-sm font-medium text-[#8C5319] mb-2">О предприятии</p>
              <h2 className="font-display text-3xl font-semibold text-[#1F1915] tracking-tight mb-5 text-balance">
                Ведущий производитель хлеба в Камышинском районе
              </h2>
              <p className="text-base text-[#3D352E] leading-relaxed mb-4">
                АО «Камышинский хлебокомбинат» выпускает 10 видов хлеба и более 65 видов
                хлебобулочных изделий — булочные, бараночные, кондитерские и сухарные изделия.
                Предприятие постоянно совершенствует технологии производства, качество и внешний
                вид продукции.
              </p>
              <ul className="space-y-2.5 text-sm text-[#5C534A] mb-7 list-disc pl-5">
                <li>Новейшее высокотехнологичное хлебопекарное оборудование</li>
                <li>Собственная сертифицированная лаборатория для контроля качества</li>
                <li>Гибкая система скидок и индивидуальные условия для партнёров</li>
                <li>Только натуральное экологически чистое российское сырьё</li>
                <li>Строгое соблюдение графиков доставки по торговым сетям</li>
              </ul>
              <div className="flex flex-wrap items-center gap-6">
                <Link
                  to="/about"
                  className="inline-flex items-center gap-1.5 text-sm font-semibold text-[#B82D25] hover:text-[#93211A]"
                >
                  Подробнее о компании
                  <ArrowRight className="w-4 h-4" aria-hidden="true" />
                </Link>
                <Link
                  to="/vacancies"
                  className="text-sm font-medium text-[#5C534A] hover:text-[#1F1915] underline underline-offset-4"
                >
                  Открытые вакансии
                </Link>
              </div>
            </div>

            <div className="lg:col-span-6 lg:border-l lg:border-[#E5DDD3] lg:pl-12">
              <div className="flex items-end justify-between gap-4 mb-6">
                <div>
                  <p className="text-sm font-medium text-[#8C5319] mb-1">Жизнь комбината</p>
                  <h2 className="font-display text-3xl font-semibold text-[#1F1915] tracking-tight">
                    Новости
                  </h2>
                </div>
                <Link
                  to="/news"
                  className="text-sm font-medium text-[#B82D25] hover:text-[#93211A] whitespace-nowrap shrink-0"
                >
                  Все новости
                </Link>
              </div>

              <div className="divide-y divide-[#EFE8DF]">
                {latestNews.map((item) => (
                  <article key={item.id} className="py-5 first:pt-0 last:pb-0 flex gap-4">
                    <Link
                      to={`/news/${item.id}`}
                      className="w-24 h-20 rounded-lg overflow-hidden bg-[#F3EFE8] shrink-0 border border-[#E5DDD3]"
                    >
                      <SafeImage
                        src={item.image}
                        alt={item.title}
                        className="w-full h-full object-cover"
                      />
                    </Link>
                    <div className="min-w-0">
                      <time className="block text-xs text-[#786D62] mb-1 tabular-nums">
                        {formatRuDate(item.createdAt)}
                      </time>
                      <h3 className="font-sans text-base font-semibold text-[#1F1915] leading-snug mb-1.5">
                        <Link
                          to={`/news/${item.id}`}
                          className="hover:text-[#B82D25] transition-colors"
                        >
                          {item.title}
                        </Link>
                      </h3>
                      <p className="text-sm text-[#5C534A] line-clamp-2">{item.description}</p>
                    </div>
                  </article>
                ))}
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Section 4: Retail Partners */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16">
        <div className="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
          <div>
            <p className="text-sm font-medium text-[#8C5319] mb-1">Федеральные и региональные сети</p>
            <h2 className="font-display text-2xl sm:text-3xl font-semibold text-[#1F1915] tracking-tight">
              С нами сотрудничают
            </h2>
          </div>
          <Link
            to="/partners"
            className="text-sm font-medium text-[#5C534A] hover:text-[#B82D25] transition-colors"
          >
            Условия поставки →
          </Link>
        </div>

        <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
          {PARTNER_LOGOS.map((partner) => (
            <a
              key={partner.name}
              href={partner.href}
              target="_blank"
              rel="noreferrer"
              aria-label={`Партнёр ${partner.name}`}
              className="bg-white border border-[#E5DDD3] rounded-xl p-5 flex items-center justify-center h-24 hover:border-[#C5B7A5] transition-colors"
            >
              <img
                src={partner.src}
                alt={partner.name}
                className="max-h-12 max-w-full object-contain"
              />
            </a>
          ))}
        </div>
      </section>
    </div>
  );
}
