import { useState, type FormEvent } from 'react';
import { CheckCircle2, MapPin } from 'lucide-react';
import { apiFetch } from '../lib/api';
import { validateContactForm } from '../lib/catalog';
import { PageBanner } from '../components/Layout';

const DEPARTMENTS = [
  {
    name: 'Приём заявок (отдел сбыта)',
    phones: ['(84457) 9-64-56', '+7 (937) 535-11-19'],
    emails: ['expedition@kambread.ru'],
  },
  {
    name: 'Отдел маркетинга и продаж',
    phones: ['(84457) 9-39-84', '+7 (937) 535-11-14'],
    emails: ['marketing@kambread.ru', 'sales.department@kambread.ru'],
  },
  {
    name: 'Приёмная (секретарь)',
    phones: ['(84457) 9-64-64 (тел/факс)'],
    emails: ['secretary@kambread.ru'],
  },
  {
    name: 'Отдел кадров',
    phones: ['(84457) 9-63-44'],
    emails: ['hr.department@kambread.ru'],
  },
  {
    name: 'Бухгалтерия',
    phones: ['(84457) 9-63-77'],
    emails: ['buhgaltery@kambread.ru'],
  },
  {
    name: 'Лаборатория и ОТК',
    phones: ['(84457) 9-64-05'],
    emails: ['laboratory@kambread.ru'],
  },
] as const;

export function ContactPage() {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [subject, setSubject] = useState('');
  const [body, setBody] = useState('');
  const [errors, setErrors] = useState<Record<string, string>>({});
  const [submitting, setSubmitting] = useState(false);
  const [successMsg, setSuccessMsg] = useState<string | null>(null);
  const [submitError, setSubmitError] = useState<string | null>(null);

  const handleSubmit = async (e: FormEvent) => {
    e.preventDefault();
    const validation = validateContactForm({ name, email, subject, body });
    setErrors(validation);
    setSubmitError(null);
    if (Object.keys(validation).length > 0) return;

    setSubmitting(true);
    try {
      const res = await apiFetch<{ message: string }>('/api/contact', {
        method: 'POST',
        body: JSON.stringify({ name, email, subject, body }),
      });
      setSuccessMsg(res.message);
      setName('');
      setEmail('');
      setSubject('');
      setBody('');
      setErrors({});
    } catch (err) {
      setSubmitError(err instanceof Error ? err.message : 'Не удалось отправить сообщение');
    } finally {
      setSubmitting(false);
    }
  };

  return (
    <div>
      <PageBanner
        title="Контакты"
        subtitle="403874, Волгоградская область, г. Камышин, ул. Ленина, 4"
        crumbs={[{ label: 'Контакты' }]}
      />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
          {/* Directory */}
          <div className="lg:col-span-7 space-y-6">
            <h2 className="font-display text-2xl sm:text-3xl font-semibold text-[#1F1915]">
              Связаться с нами
            </h2>

            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
              {DEPARTMENTS.map((dept) => (
                <div
                  key={dept.name}
                  className="bg-white border border-[#E5DDD3] rounded-xl p-5"
                >
                  <h3 className="font-sans text-sm font-semibold text-[#1F1915] mb-2">
                    {dept.name}
                  </h3>
                  <div className="space-y-1 text-sm tabular-nums text-[#3D352E]">
                    {dept.phones.map((phone) => (
                      <p key={phone}>{phone}</p>
                    ))}
                  </div>
                  <div className="mt-2.5 space-y-1 text-xs">
                    {dept.emails.map((mail) => (
                      <a
                        key={mail}
                        href={`mailto:${mail}`}
                        className="block text-[#B82D25] hover:underline break-all"
                      >
                        {mail}
                      </a>
                    ))}
                  </div>
                </div>
              ))}
            </div>
          </div>

          {/* Feedback Form */}
          <div className="lg:col-span-5 bg-white border border-[#E5DDD3] rounded-xl p-6 sm:p-8">
            <h2 className="font-display text-2xl font-semibold text-[#1F1915] mb-2">
              Отправить отзыв
            </h2>
            <p className="text-sm text-[#5C534A] mb-6">
              Напишите в отдел маркетинга по вопросам поставок, качества продукции или отзывов.
            </p>

            {successMsg && (
              <div
                role="status"
                className="mb-6 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm flex items-start gap-3"
              >
                <CheckCircle2 className="w-5 h-5 text-emerald-700 shrink-0 mt-0.5" />
                <div>
                  <p className="font-medium">{successMsg}</p>
                  <p className="text-xs text-emerald-800 mt-0.5">
                    Благодарим за обращение! Мы ответим в ближайшее рабочее время.
                  </p>
                </div>
              </div>
            )}

            <form onSubmit={handleSubmit} noValidate className="space-y-4">
              <div>
                <label htmlFor="contact-name" className="block text-xs font-medium text-[#5C534A] mb-1">
                  Ваше имя
                </label>
                <input
                  id="contact-name"
                  type="text"
                  value={name}
                  onChange={(e) => setName(e.target.value)}
                  placeholder="Иван Петров"
                  className="w-full px-3.5 py-2.5 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md focus:outline-none focus:ring-2 focus:ring-[#B82D25]"
                />
                {errors.name && <p className="mt-1 text-xs text-red-700">{errors.name}</p>}
              </div>

              <div>
                <label htmlFor="contact-email" className="block text-xs font-medium text-[#5C534A] mb-1">
                  Ваш e-mail
                </label>
                <input
                  id="contact-email"
                  type="email"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  placeholder="name@example.ru"
                  className="w-full px-3.5 py-2.5 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md focus:outline-none focus:ring-2 focus:ring-[#B82D25]"
                />
                {errors.email && <p className="mt-1 text-xs text-red-700">{errors.email}</p>}
              </div>

              <div>
                <label htmlFor="contact-subject" className="block text-xs font-medium text-[#5C534A] mb-1">
                  Тема сообщения
                </label>
                <input
                  id="contact-subject"
                  type="text"
                  value={subject}
                  onChange={(e) => setSubject(e.target.value)}
                  placeholder="Оптовая поставка / Отзыв о продукции"
                  className="w-full px-3.5 py-2.5 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md focus:outline-none focus:ring-2 focus:ring-[#B82D25]"
                />
                {errors.subject && <p className="mt-1 text-xs text-red-700">{errors.subject}</p>}
              </div>

              <div>
                <label htmlFor="contact-body" className="block text-xs font-medium text-[#5C534A] mb-1">
                  Сообщение
                </label>
                <textarea
                  id="contact-body"
                  rows={5}
                  value={body}
                  onChange={(e) => setBody(e.target.value)}
                  placeholder="Расскажите, чем мы можем помочь..."
                  className="w-full px-3.5 py-2.5 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md focus:outline-none focus:ring-2 focus:ring-[#B82D25]"
                />
                {errors.body && <p className="mt-1 text-xs text-red-700">{errors.body}</p>}
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
                {submitting ? 'Отправка...' : 'Отправить'}
              </button>
            </form>
          </div>
        </div>

        {/* Location Card */}
        <section className="bg-white border border-[#E5DDD3] rounded-xl p-6 sm:p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
          <div className="flex items-start gap-4">
            <div className="w-11 h-11 rounded-lg bg-[#F3EFE8] border border-[#E5DDD3] flex items-center justify-center text-[#B82D25] shrink-0">
              <MapPin className="w-5 h-5" aria-hidden="true" />
            </div>
            <div>
              <h2 className="font-display text-xl font-semibold text-[#1F1915]">
                Адрес производственной площадки
              </h2>
              <p className="text-sm text-[#5C534A] mt-1">
                403874, Российская Федерация, Волгоградская область, г. Камышин, ул. Ленина, 4
              </p>
              <p className="text-xs text-[#786D62] mt-1 tabular-nums">
                Координаты: 50.1070° с. ш., 45.4038° в. д.
              </p>
            </div>
          </div>
          <a
            href="https://maps.google.com/?q=50.106984,45.403804"
            target="_blank"
            rel="noreferrer"
            className="px-4 py-2.5 rounded-md border border-[#D4C7B8] text-sm font-medium text-[#1F1915] hover:bg-[#FAF8F5] transition-colors whitespace-nowrap shrink-0"
          >
            Открыть на карте
          </a>
        </section>
      </div>
    </div>
  );
}
