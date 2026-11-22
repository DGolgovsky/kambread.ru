import { Link } from 'react-router-dom';
import { ArrowLeft } from 'lucide-react';

export function NotFoundPage() {
  return (
    <div className="max-w-2xl mx-auto px-4 py-20 text-center">
      <img
        src="/images/404.png"
        alt="Страница не найдена"
        className="max-h-56 mx-auto mb-8 object-contain"
      />
      <h1 className="font-display text-3xl sm:text-4xl font-semibold text-[#1F1915] mb-3">
        Страница не найдена
      </h1>
      <p className="text-sm sm:text-base text-[#5C534A] mb-8">
        Запрашиваемая страница была перемещена или удалена. Вернитесь на главную или откройте
        каталог продукции.
      </p>
      <div className="flex flex-wrap items-center justify-center gap-4">
        <Link
          to="/"
          className="inline-flex items-center gap-2 px-5 py-2.5 rounded-md bg-[#B82D25] text-white text-sm font-medium hover:bg-[#93211A]"
        >
          <ArrowLeft className="w-4 h-4" aria-hidden="true" />
          На главную
        </Link>
        <Link
          to="/products"
          className="px-5 py-2.5 rounded-md border border-[#D4C7B8] bg-white text-sm font-medium text-[#1F1915] hover:bg-[#FAF8F5]"
        >
          Каталог продукции
        </Link>
      </div>
    </div>
  );
}
