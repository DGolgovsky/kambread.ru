import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { apiFetch } from '../lib/api';
import type { AwardItem } from '../lib/types';
import { PageBanner } from '../components/Layout';
import { SafeImage } from '../components/SafeImage';

export function AboutPage() {
  const [awards, setAwards] = useState<AwardItem[]>([]);
  const [selectedAwardIdx, setSelectedAwardIdx] = useState(0);

  useEffect(() => {
    apiFetch<{ items: AwardItem[] }>('/api/awards')
      .then((res) => setAwards(res.items))
      .catch(() => {});
  }, []);

  const activeAward = awards[selectedAwardIdx];

  return (
    <div>
      <PageBanner
        title="О компании"
        subtitle="АО «Камышинский хлебокомбинат» основан в декабре 1956 года."
        crumbs={[{ label: 'О компании' }]}
      />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">
        {/* History & Leadership */}
        <section className="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
          <div className="lg:col-span-8 space-y-4 text-base text-[#3D352E] leading-relaxed">
            <h2 className="font-display text-3xl font-semibold text-[#1F1915] mb-2">
              История и производство
            </h2>
            <p>
              В 1993 году хлебокомбинат вышел из подчинения Министерства хлебопекарной
              промышленности и стал структурой муниципалитета. В августе 2006 года было создано
              ОАО «Камышинский хлебокомбинат» путём преобразования муниципального унитарного
              предприятия «Камышинский хлебокомбинат». Учредителем АО «Камышинский хлебокомбинат»
              является комитет по управлению имуществом Администрации городского округа — город
              Камышин.
            </p>
            <p>
              АО «Камышинский хлебокомбинат» — один из крупнейших производителей хлебобулочной
              продукции в Волгоградской области и лидер хлебопечения в Камышинском районе.
              Предприятие специализируется как на выпечке, так и на реализации выпускаемой
              продукции. Вся продукция сертифицирована и декларирована в соответствии с
              требованиями Технического регламента Таможенного союза.
            </p>
            <p>
              На каждом этапе проводится входная проверка поступающего сырья и технологический
              контроль производства. Контроль качества готовых изделий выполняется силами
              собственной лаборатории.
            </p>

            <div className="pt-4">
              <h3 className="font-sans text-base font-semibold text-[#1F1915] mb-3">
                Основные виды выпускаемой продукции:
              </h3>
              <ul className="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-sm text-[#5C534A] list-disc pl-5">
                <li>Хлеб пшеничный, ржано-пшеничный, диетический, с пряностями</li>
                <li>Бублики, баранки, сушки в современной евроупаковке</li>
                <li>Булочки простые, сдобные, слоёные, с начинкой, батоны, рулеты, кексы, коржи</li>
                <li>Батончики, сдобы, сухарики и праздничные караваи</li>
              </ul>
            </div>
          </div>

          <aside className="lg:col-span-4 bg-white border border-[#E5DDD3] rounded-xl p-6 text-center">
            <div className="w-52 h-52 mx-auto rounded-xl overflow-hidden bg-[#F3EFE8] border border-[#E5DDD3] mb-4">
              <SafeImage
                src="/images/about/director.png"
                alt="Генеральный директор Кутепов Ю. Н."
                className="w-full h-full object-cover object-top"
              />
            </div>
            <p className="text-xs text-[#8C5319] font-medium mb-1">Руководство предприятия</p>
            <h3 className="font-display text-xl font-semibold text-[#1F1915]">
              Кутепов Ю. Н.
            </h3>
            <p className="text-sm text-[#5C534A] mt-1">Генеральный директор</p>
            <div className="mt-5 pt-5 border-t border-[#EFE8DF] text-left text-xs text-[#5C534A] space-y-2">
              <p>
                Приоритет руководства — непрерывная модернизация производственных линий и
                сохранение традиционного вкуса камышинского хлеба.
              </p>
              <Link
                to="/vacancies"
                className="inline-block text-[#B82D25] font-medium hover:underline pt-1"
              >
                Работа на предприятии →
              </Link>
            </div>
          </aside>
        </section>

        {/* Social Responsibility & Watermelon Festival */}
        <section className="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center bg-white border border-[#E5DDD3] rounded-xl p-6 sm:p-10">
          <div className="lg:col-span-4">
            <div className="aspect-square max-w-xs mx-auto rounded-xl overflow-hidden border border-[#E5DDD3] bg-[#F3EFE8]">
              <SafeImage
                src="/images/about/watermelon.jpg"
                alt="Камышинский арбузный фестиваль"
                className="w-full h-full object-cover"
              />
            </div>
            <p className="text-center text-xs text-[#6B6056] mt-3">
              Ежегодный Камышинский арбузный фестиваль
            </p>
          </div>

          <div className="lg:col-span-8 space-y-4 text-base text-[#3D352E] leading-relaxed">
            <h2 className="font-display text-2xl sm:text-3xl font-semibold text-[#1F1915]">
              Социальная ответственность и коллектив
            </h2>
            <p>
              Компания за счёт собственных средств оказывает благотворительную помощь общественным,
              государственным и муниципальным организациям, ветеранам и жителям города, участвует
              в благоустройстве и создании памятных знаков в г. Камышине.
            </p>
            <p>
              На предприятии обеспечиваются все социальные гарантии, строго соблюдаются нормы
              трудового и пенсионного законодательства. Работникам гарантированы дополнительные
              выплаты и льготы согласно коллективному договору, программа комплексного медицинского
              обслуживания и санаторно-курортного лечения, а в летний период — путёвки в детские
              оздоровительные лагеря.
            </p>
            <p>
              Представители коллектива АО «Камышинский хлебокомбинат» являются постоянными
              участниками и неоднократными победителями ежегодного Камышинского арбузного фестиваля.
            </p>
          </div>
        </section>

        {/* Awards & Achievements */}
        <section>
          <div className="mb-8">
            <p className="text-sm font-medium text-[#8C5319] mb-1">Признание качества</p>
            <h2 className="font-display text-3xl font-semibold text-[#1F1915]">
              Достижения и результаты деятельности предприятия
            </h2>
          </div>

          <div className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <div className="lg:col-span-8 divide-y divide-[#E5DDD3] bg-white border border-[#E5DDD3] rounded-xl">
              {awards.map((award, index) => (
                <button
                  key={award.id}
                  type="button"
                  onClick={() => setSelectedAwardIdx(index)}
                  className={`w-full text-left p-5 sm:p-6 flex flex-col sm:flex-row sm:items-baseline gap-3 sm:gap-6 transition-colors first:rounded-t-xl last:rounded-b-xl ${
                    index === selectedAwardIdx
                      ? 'bg-[#F8F3EC]'
                      : 'hover:bg-[#FAF8F5]'
                  }`}
                >
                  <span className="font-display text-2xl font-semibold text-[#B82D25] tabular-nums shrink-0 w-16">
                    {award.year}
                  </span>
                  <span className="text-sm sm:text-base text-[#1F1915] leading-relaxed">
                    {award.description}
                  </span>
                </button>
              ))}
            </div>

            {activeAward && (
              <div className="lg:col-span-4 bg-white border border-[#E5DDD3] rounded-xl p-5">
                <div className="aspect-[4/3] rounded-lg overflow-hidden bg-[#F3EFE8] border border-[#E5DDD3] mb-4">
                  <SafeImage
                    src={activeAward.image}
                    alt={`Награда ${activeAward.year} года`}
                    className="w-full h-full object-cover"
                  />
                </div>
                <p className="text-xs font-semibold text-[#8C5319] tabular-nums mb-1">
                  Награда · {activeAward.year} г.
                </p>
                <p className="text-sm text-[#3D352E] leading-relaxed">
                  {activeAward.description}
                </p>
              </div>
            )}
          </div>
        </section>
      </div>
    </div>
  );
}
