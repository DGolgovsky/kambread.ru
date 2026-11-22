import { Link } from 'react-router-dom';
import { ArrowRight } from 'lucide-react';
import { PageBanner } from '../components/Layout';
import { SafeImage } from '../components/SafeImage';

export function PartnersPage() {
  return (
    <div>
      <PageBanner
        title="Партнёрам"
        subtitle="Условия заключения договоров поставки продукции, сырья и материалов."
        crumbs={[{ label: 'Партнёрам' }]}
      />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
          <div className="lg:col-span-8 space-y-8">
            <div className="bg-white border border-[#E5DDD3] rounded-xl p-6 sm:p-8">
              <h2 className="font-display text-2xl sm:text-3xl font-semibold text-[#1F1915] mb-4">
                Начало сотрудничества
              </h2>
              <p className="text-base text-[#3D352E] leading-relaxed">
                Для начала сотрудничества с АО «Камышинский хлебокомбинат» и заключения договора
                поставки продукции, сырья или материалов обратитесь в отдел продаж по телефону{' '}
                <a
                  href="tel:+78445793984"
                  className="font-semibold text-[#1F1915] tabular-nums hover:text-[#B82D25]"
                >
                  (84457) 9-39-84
                </a>{' '}
                или по электронной почте{' '}
                <a
                  href="mailto:marketing@kambread.ru"
                  className="font-semibold text-[#B82D25] hover:underline"
                >
                  marketing@kambread.ru
                </a>
                .
              </p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div className="bg-white border border-[#E5DDD3] rounded-xl p-6">
                <h3 className="font-display text-xl font-semibold text-[#1F1915] mb-3">
                  Юридическим лицам
                </h3>
                <p className="text-xs text-[#6B6056] mb-4">
                  Необходимо предоставить заверенные копии и оригиналы:
                </p>
                <ul className="space-y-2 text-sm text-[#3D352E] list-disc pl-5">
                  <li>Свидетельство ИНН</li>
                  <li>Свидетельство ОГРН</li>
                  <li>Устав организации</li>
                  <li>Документы, подтверждающие полномочия руководителя</li>
                  <li>Актуальная выписка из ЕГРЮЛ</li>
                </ul>
              </div>

              <div className="bg-white border border-[#E5DDD3] rounded-xl p-6">
                <h3 className="font-display text-xl font-semibold text-[#1F1915] mb-3">
                  Индивидуальным предпринимателям
                </h3>
                <p className="text-xs text-[#6B6056] mb-4">
                  Необходимо предоставить заверенные копии и оригиналы:
                </p>
                <ul className="space-y-2 text-sm text-[#3D352E] list-disc pl-5">
                  <li>Свидетельство ИНН</li>
                  <li>Свидетельство ОГРНИП / лист записи ЕГРИП</li>
                  <li>Паспорт гражданина РФ</li>
                </ul>
              </div>
            </div>

            <div className="bg-white border border-[#E5DDD3] rounded-xl p-6 sm:p-8">
              <h3 className="font-display text-2xl font-semibold text-[#1F1915] mb-4">
                Мы предлагаем партнёрам
              </h3>
              <ul className="space-y-2.5 text-base text-[#3D352E] list-disc pl-5 mb-6">
                <li>
                  Широкий ассортимент сертифицированной продукции, соответствующей всем требованиям
                  стандартов качества и ТР ТС
                </li>
                <li>Индивидуальный подход к каждому клиенту и гибкая система скидок</li>
                <li>Ежедневная утренняя доставка собственным специализированным транспортом</li>
              </ul>
              <Link
                to="/contact"
                className="inline-flex items-center gap-2 px-5 py-2.5 rounded-md bg-[#B82D25] text-white text-sm font-medium hover:bg-[#93211A] transition-colors"
              >
                Связаться с отделом продаж
                <ArrowRight className="w-4 h-4" aria-hidden="true" />
              </Link>
            </div>
          </div>

          <aside className="lg:col-span-4 space-y-6">
            <div className="bg-white border border-[#E5DDD3] rounded-xl p-5">
              <div className="rounded-lg overflow-hidden bg-[#F3EFE8] mb-3">
                <SafeImage
                  src="/images/partners/delivery.png"
                  alt="Своевременная доставка продукции"
                  className="w-full h-48 object-contain p-3"
                />
              </div>
              <p className="text-sm font-semibold text-[#1F1915]">Своевременная доставка</p>
              <p className="text-xs text-[#5C534A] mt-1">
                Собственная логистика по г. Камышину и Волгоградской области.
              </p>
            </div>

            <div className="bg-white border border-[#E5DDD3] rounded-xl p-5">
              <div className="rounded-lg overflow-hidden bg-[#F3EFE8] mb-3">
                <SafeImage
                  src="/images/partners/come_to_us.jpg"
                  alt="Печём с душой"
                  className="w-full h-52 object-cover"
                />
              </div>
              <p className="text-sm font-semibold text-[#1F1915]">Печём с душой с 1956 года</p>
              <p className="text-xs text-[#5C534A] mt-1">
                Будем рады видеть вас среди наших постоянных клиентов.
              </p>
            </div>
          </aside>
        </div>
      </div>
    </div>
  );
}
