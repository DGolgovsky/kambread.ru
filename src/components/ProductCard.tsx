import { Link } from 'react-router-dom';
import { ArrowRight } from 'lucide-react';
import { formatRub, formatWeight } from '../lib/catalog';
import type { Product } from '../lib/types';
import { SafeImage } from './SafeImage';

export function ProductCard({ product }: { product: Product }) {
  const statusLabel = product.isNew
    ? 'Новинка'
    : product.isRecommend
      ? 'Рекомендуем'
      : null;

  return (
    <article className="group bg-white border border-[#E5DDD3] rounded-xl overflow-hidden flex flex-col transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
      <Link
        to={`/products/${product.id}`}
        className="block aspect-[4/3] bg-[#F3EFE8] overflow-hidden focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-[#B82D25]"
      >
        <SafeImage
          src={product.image}
          alt={product.name}
          fallbackLabel={product.shortName}
          className="w-full h-full object-cover transition-transform duration-300 group-hover:scale-[1.03]"
        />
      </Link>

      <div className="p-5 flex-1 flex flex-col">
        <div className="flex items-center gap-2 text-xs text-[#5C534A] mb-2">
          <span>{product.type}</span>
          <span aria-hidden="true">·</span>
          <span className="tabular-nums">{formatWeight(product.weight)}</span>
          {statusLabel && (
            <>
              <span aria-hidden="true">·</span>
              <span
                className={
                  product.isNew
                    ? 'font-semibold text-[#B82D25]'
                    : 'font-medium text-[#8C5319]'
                }
              >
                {statusLabel}
              </span>
            </>
          )}
        </div>

        <h3 className="font-sans text-base font-semibold text-[#1F1915] leading-snug mb-2">
          <Link
            to={`/products/${product.id}`}
            className="hover:text-[#B82D25] transition-colors focus-visible:outline-none focus-visible:underline"
          >
            {product.shortName}
          </Link>
        </h3>

        <p className="text-sm text-[#5C534A] line-clamp-2 mb-5 flex-1">
          {product.description}
        </p>

        <div className="pt-4 border-t border-[#EFE8DF] flex items-center justify-between gap-4">
          <span className="text-lg font-semibold text-[#1F1915] tabular-nums">
            {formatRub(product.price)}
          </span>
          <Link
            to={`/products/${product.id}`}
            className="inline-flex items-center gap-1.5 text-sm font-medium text-[#B82D25] hover:text-[#93211A] whitespace-nowrap shrink-0 transition-colors"
          >
            Подробнее
            <ArrowRight className="w-4 h-4" aria-hidden="true" />
          </Link>
        </div>
      </div>
    </article>
  );
}
