import { useState, type ReactNode } from 'react';
import { Link, NavLink, useLocation } from 'react-router-dom';
import { ChevronRight, Menu, X } from 'lucide-react';
import { useAuth } from '../context/AuthContext';

const PRIMARY_NAV = [
  { to: '/products', label: 'Продукция' },
  { to: '/about', label: 'О компании' },
  { to: '/partners', label: 'Партнёрам' },
  { to: '/news', label: 'Новости' },
  { to: '/contact', label: 'Контакты' },
] as const;

export function Layout({ children }: { children: ReactNode }) {
  const { user } = useAuth();
  const [mobileOpen, setMobileOpen] = useState(false);
  const location = useLocation();

  return (
    <div className="min-h-screen flex flex-col bg-[#FAF8F5] text-[#1F1915]">
      <header className="sticky top-0 z-40 bg-[#FAF8F5]/95 backdrop-blur-sm border-b border-[#E5DDD3]">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-8">
          {/* Zone 1: Brand wordmark */}
          <Link
            to="/"
            onClick={() => setMobileOpen(false)}
            className="font-display text-lg sm:text-xl font-semibold tracking-tight text-[#1F1915] hover:text-[#B82D25] transition-colors whitespace-nowrap shrink-0 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#B82D25] rounded"
          >
            Камышинский хлебокомбинат
          </Link>

          {/* Zone 2: 5 concise single-line nav links */}
          <nav aria-label="Основная навигация" className="hidden md:flex items-center gap-7">
            {PRIMARY_NAV.map((item) => (
              <NavLink
                key={item.to}
                to={item.to}
                className={({ isActive }) =>
                  `text-sm font-medium whitespace-nowrap shrink-0 py-1 border-b-2 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#B82D25] rounded-sm ${
                    isActive
                      ? 'text-[#B82D25] border-[#B82D25]'
                      : 'text-[#5C534A] border-transparent hover:text-[#1F1915] hover:border-[#D5C9BA]'
                  }`
                }
              >
                {item.label}
              </NavLink>
            ))}
          </nav>

          {/* Zone 3: 1 primary action + mobile menu button */}
          <div className="flex items-center gap-3 shrink-0">
            <Link
              to={user ? '/cabinet' : '/login'}
              onClick={() => setMobileOpen(false)}
              className="hidden sm:inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-md bg-[#B82D25] text-white hover:bg-[#93211A] transition-colors whitespace-nowrap shrink-0 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-[#B82D25]"
            >
              {user ? 'Кабинет' : 'Войти'}
            </Link>

            <button
              type="button"
              onClick={() => setMobileOpen((open) => !open)}
              aria-expanded={mobileOpen}
              aria-label={mobileOpen ? 'Закрыть меню' : 'Открыть меню'}
              className="md:hidden inline-flex items-center justify-center w-11 h-11 rounded-md border border-[#E5DDD3] text-[#1F1915] hover:bg-[#F3EFE8] transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#B82D25]"
            >
              {mobileOpen ? <X className="w-5 h-5" /> : <Menu className="w-5 h-5" />}
            </button>
          </div>
        </div>

        {/* Mobile navigation drawer */}
        {mobileOpen && (
          <nav
            aria-label="Мобильное меню"
            className="md:hidden border-t border-[#E5DDD3] bg-[#FAF8F5] px-4 py-4 space-y-1"
          >
            <Link
              to="/"
              onClick={() => setMobileOpen(false)}
              className={`block px-3 py-2.5 rounded-md text-base font-medium ${
                location.pathname === '/'
                  ? 'bg-[#F3EFE8] text-[#B82D25]'
                  : 'text-[#1F1915] hover:bg-[#F3EFE8]'
              }`}
            >
              Главная
            </Link>
            {PRIMARY_NAV.map((item) => (
              <NavLink
                key={item.to}
                to={item.to}
                onClick={() => setMobileOpen(false)}
                className={({ isActive }) =>
                  `block px-3 py-2.5 rounded-md text-base font-medium ${
                    isActive
                      ? 'bg-[#F3EFE8] text-[#B82D25]'
                      : 'text-[#1F1915] hover:bg-[#F3EFE8]'
                  }`
                }
              >
                {item.label}
              </NavLink>
            ))}
            <NavLink
              to="/vacancies"
              onClick={() => setMobileOpen(false)}
              className={({ isActive }) =>
                `block px-3 py-2.5 rounded-md text-base font-medium ${
                  isActive
                    ? 'bg-[#F3EFE8] text-[#B82D25]'
                    : 'text-[#1F1915] hover:bg-[#F3EFE8]'
                }`
              }
            >
              Вакансии
            </NavLink>
            <div className="pt-3 mt-2 border-t border-[#E5DDD3]">
              <Link
                to={user ? '/cabinet' : '/login'}
                onClick={() => setMobileOpen(false)}
                className="block w-full text-center px-4 py-2.5 rounded-md bg-[#B82D25] text-white text-sm font-medium hover:bg-[#93211A]"
              >
                {user ? 'Личный кабинет' : 'Войти в кабинет'}
              </Link>
            </div>
          </nav>
        )}
      </header>

      <main className="flex-1">{children}</main>

      <footer className="bg-[#1F1915] text-[#D8CFC4] mt-20 border-t border-[#342B24]">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <div>
              <div className="flex items-center gap-3 mb-4">
                <img
                  src="/images/logo_color_rectangle_h100.png"
                  alt="АО «Камышинский хлебокомбинат»"
                  className="h-12 w-auto bg-white/95 rounded px-2 py-1"
                />
              </div>
              <p className="text-sm text-[#B7AC9F] leading-relaxed">
                АО «Камышинский хлебокомбинат» — ведущий производитель хлеба и хлебобулочных
                изделий Волгоградской области с декабря 1956 года.
              </p>
              <div className="mt-5 flex items-center gap-4 text-sm">
                <a
                  href="https://vk.com/kam.hleb"
                  target="_blank"
                  rel="noreferrer"
                  className="text-[#D8CFC4] hover:text-white underline-offset-4 hover:underline"
                >
                  ВКонтакте
                </a>
                <span aria-hidden="true" className="text-[#5C534A]">·</span>
                <a
                  href="https://ok.ru/group/52685470564514"
                  target="_blank"
                  rel="noreferrer"
                  className="text-[#D8CFC4] hover:text-white underline-offset-4 hover:underline"
                >
                  Одноклассники
                </a>
              </div>
            </div>

            <div>
              <h2 className="font-sans text-sm font-semibold text-white mb-4">Разделы сайта</h2>
              <ul className="space-y-2.5 text-sm">
                <li>
                  <Link to="/products" className="hover:text-white transition-colors">
                    Каталог продукции
                  </Link>
                </li>
                <li>
                  <Link to="/about" className="hover:text-white transition-colors">
                    О компании и награды
                  </Link>
                </li>
                <li>
                  <Link to="/partners" className="hover:text-white transition-colors">
                    Партнёрам и оптовым клиентам
                  </Link>
                </li>
                <li>
                  <Link to="/vacancies" className="hover:text-white transition-colors">
                    Вакансии предприятия
                  </Link>
                </li>
                <li>
                  <Link to="/news" className="hover:text-white transition-colors">
                    Новости комбината
                  </Link>
                </li>
                <li>
                  <a
                    href="http://disclosure.1prime.ru/portal/default.aspx?emId=3436107766"
                    target="_blank"
                    rel="noreferrer"
                    className="hover:text-white transition-colors"
                  >
                    Раскрытие информации
                  </a>
                </li>
              </ul>
            </div>

            <div>
              <h2 className="font-sans text-sm font-semibold text-white mb-4">Телефоны</h2>
              <dl className="space-y-2 text-sm tabular-nums">
                <div className="flex justify-between gap-4">
                  <dt className="text-[#B7AC9F]">Приёмная</dt>
                  <dd className="text-white">(84457) 9-64-64</dd>
                </div>
                <div className="flex justify-between gap-4">
                  <dt className="text-[#B7AC9F]">Отдел маркетинга</dt>
                  <dd className="text-white">(84457) 9-39-84</dd>
                </div>
                <div className="flex justify-between gap-4">
                  <dt className="text-[#B7AC9F]">Отдел сбыта</dt>
                  <dd className="text-white">(84457) 9-64-56</dd>
                </div>
                <div className="flex justify-between gap-4">
                  <dt className="text-[#B7AC9F]">Отдел кадров</dt>
                  <dd className="text-white">(84457) 9-63-44</dd>
                </div>
                <div className="flex justify-between gap-4">
                  <dt className="text-[#B7AC9F]">Лаборатория</dt>
                  <dd className="text-white">(84457) 9-64-05</dd>
                </div>
              </dl>
            </div>

            <div>
              <h2 className="font-sans text-sm font-semibold text-white mb-4">Адрес и почта</h2>
              <p className="text-sm text-[#B7AC9F] leading-relaxed mb-4">
                403874, Россия, Волгоградская область,
                <br />
                г. Камышин, ул. Ленина, 4
              </p>
              <dl className="space-y-2 text-sm">
                <div>
                  <dt className="text-xs text-[#9E9284]">Отдел продаж</dt>
                  <dd>
                    <a
                      href="mailto:marketing@kambread.ru"
                      className="text-white hover:underline underline-offset-4"
                    >
                      marketing@kambread.ru
                    </a>
                  </dd>
                </div>
                <div>
                  <dt className="text-xs text-[#9E9284]">Отдел сбыта</dt>
                  <dd>
                    <a
                      href="mailto:expedition@kambread.ru"
                      className="text-white hover:underline underline-offset-4"
                    >
                      expedition@kambread.ru
                    </a>
                  </dd>
                </div>
                <div>
                  <dt className="text-xs text-[#9E9284]">Поддержка сайта</dt>
                  <dd>
                    <a
                      href="mailto:support@kambread.ru"
                      className="text-white hover:underline underline-offset-4"
                    >
                      support@kambread.ru
                    </a>
                  </dd>
                </div>
              </dl>
            </div>
          </div>

          <div className="mt-12 pt-6 border-t border-[#342B24] flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-[#9E9284]">
            <p>© 1956–2026 АО «Камышинский хлебокомбинат». Все права защищены.</p>
            <p>
              Полный ассортимент и оптовые цены уточняйте у менеджеров{' '}
              <Link to="/contact" className="text-[#E5DDD3] hover:text-white underline underline-offset-4">
                отдела маркетинга
              </Link>
              .
            </p>
          </div>
        </div>
      </footer>
    </div>
  );
}

export function PageBanner({
  title,
  subtitle,
  crumbs,
}: {
  title: string;
  subtitle?: string;
  crumbs: { label: string; to?: string }[];
}) {
  return (
    <section className="bg-[#F3EFE8] border-b border-[#E5DDD3]">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        <nav aria-label="Хлебные крошки" className="flex items-center flex-wrap gap-1.5 text-xs text-[#5C534A] mb-3">
          <Link to="/" className="hover:text-[#B82D25] transition-colors">
            Главная
          </Link>
          {crumbs.map((crumb, idx) => (
            <span key={idx} className="inline-flex items-center gap-1.5">
              <ChevronRight className="w-3.5 h-3.5 text-[#9E9284]" aria-hidden="true" />
              {crumb.to ? (
                <Link to={crumb.to} className="hover:text-[#B82D25] transition-colors">
                  {crumb.label}
                </Link>
              ) : (
                <span className="text-[#1F1915] font-medium">{crumb.label}</span>
              )}
            </span>
          ))}
        </nav>
        <div className="flex flex-col md:flex-row md:items-end justify-between gap-4">
          <h1 className="font-display text-3xl sm:text-4xl font-semibold text-[#1F1915] tracking-tight text-balance">
            {title}
          </h1>
          {subtitle && (
            <p className="text-sm sm:text-base text-[#5C534A] max-w-xl">{subtitle}</p>
          )}
        </div>
      </div>
    </section>
  );
}
