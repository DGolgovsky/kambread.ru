import { useEffect, useState } from 'react';
import { ChevronDown } from 'lucide-react';
import { apiFetch } from '../lib/api';
import { formatRuDate } from '../lib/catalog';
import type { VacancyItem } from '../lib/types';
import { PageBanner } from '../components/Layout';

export function VacanciesPage() {
  const [vacancies, setVacancies] = useState<VacancyItem[]>([]);
  const [loading, setLoading] = useState(true);
  const [openId, setOpenId] = useState<number | null>(null);

  useEffect(() => {
    let active = true;
    apiFetch<{ items: VacancyItem[] }>('/api/vacancies')
      .then((res) => {
        if (active) {
          setVacancies(res.items);
          if (res.items.length > 0) setOpenId(res.items[0].id);
        }
      })
      .finally(() => {
        if (active) setLoading(false);
      });
    return () => {
      active = false;
    };
  }, []);

  return (
    <div>
      <PageBanner
        title="Вакансии"
        subtitle="Узнать подробности можно в отделе кадров по телефону (84457) 9-63-44 или по почте hr.department@kambread.ru."
        crumbs={[{ label: 'Вакансии' }]}
      />

      <div className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div className="bg-white border border-[#E5DDD3] rounded-xl p-6 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div>
            <p className="text-sm font-semibold text-[#1F1915]">Отдел кадров АО «Камышинский хлебокомбинат»</p>
            <p className="text-sm text-[#5C534A] mt-1">
              Официальное трудоустройство, полный социальный пакет и льготы по коллективному договору.
            </p>
          </div>
          <div className="text-sm tabular-nums shrink-0 sm:text-right">
            <a
              href="tel:+78445796344"
              className="block font-semibold text-[#1F1915] hover:text-[#B82D25]"
            >
              (84457) 9-63-44
            </a>
            <a
              href="mailto:hr.department@kambread.ru"
              className="block text-[#B82D25] hover:underline"
            >
              hr.department@kambread.ru
            </a>
          </div>
        </div>

        {loading ? (
          <div className="space-y-3">
            {Array.from({ length: 3 }).map((_, i) => (
              <div key={i} className="h-20 rounded-xl bg-[#EFE9E0] animate-pulse" />
            ))}
          </div>
        ) : vacancies.length === 0 ? (
          <div className="bg-white border border-[#E5DDD3] rounded-xl p-10 text-center">
            <h2 className="font-display text-2xl text-[#1F1915] mb-2">
              Открытых вакансий пока нет
            </h2>
            <p className="text-sm text-[#5C534A]">
              Вы можете направить резюме в кадровый резерв на адрес hr.department@kambread.ru.
            </p>
          </div>
        ) : (
          <div className="space-y-3" data-testid="vacancies-list">
            {vacancies.map((item, idx) => {
              const isExpanded = openId === item.id;
              const num = String(idx + 1).padStart(2, '0');
              return (
                <div
                  key={item.id}
                  className="bg-white border border-[#E5DDD3] rounded-xl overflow-hidden"
                >
                  <h3>
                    <button
                      type="button"
                      aria-expanded={isExpanded}
                      onClick={() => setOpenId(isExpanded ? null : item.id)}
                      className="w-full px-6 py-5 text-left flex items-center justify-between gap-4 hover:bg-[#FAF8F5] transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-[#B82D25]"
                    >
                      <div className="flex items-baseline gap-4 min-w-0">
                        <span className="font-display text-lg font-semibold text-[#B82D25] tabular-nums shrink-0">
                          {num}.
                        </span>
                        <div className="min-w-0">
                          <span className="block font-sans text-base sm:text-lg font-semibold text-[#1F1915]">
                            {item.title}
                          </span>
                          <span className="block text-xs text-[#6B6056] mt-1">
                            {item.department} · {item.schedule} · Обновлено:{' '}
                            <span className="tabular-nums">{formatRuDate(item.updatedAt)}</span>
                          </span>
                        </div>
                      </div>
                      <ChevronDown
                        className={`w-5 h-5 text-[#5C534A] shrink-0 transition-transform duration-200 ${
                          isExpanded ? 'rotate-180' : ''
                        }`}
                        aria-hidden="true"
                      />
                    </button>
                  </h3>

                  {isExpanded && (
                    <div className="px-6 pb-6 pt-2 border-t border-[#EFE8DF] text-sm text-[#3D352E] leading-relaxed whitespace-pre-line">
                      {item.description}
                    </div>
                  )}
                </div>
              );
            })}
          </div>
        )}
      </div>
    </div>
  );
}
