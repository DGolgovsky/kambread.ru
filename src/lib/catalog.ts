import type { Product, ProductFilterParams } from './types';

export const PRICE_RANGES = [
  { value: '0-55', label: 'До 55 ₽' },
  { value: '56-90', label: '56 ₽ – 90 ₽' },
  { value: '91-140', label: '91 ₽ – 140 ₽' },
  { value: '141', label: 'От 141 ₽' },
] as const;

export function filterProducts(
  products: Product[],
  params: ProductFilterParams,
): Product[] {
  const query = (params.query ?? '').trim().toLowerCase();
  const category = (params.category ?? '').trim();
  const priceRange = (params.priceRange ?? '').trim();

  return products.filter((item) => {
    if (!params.includeUnpublished && !item.published) {
      return false;
    }

    if (query) {
      const hay = `${item.name} ${item.shortName} ${item.description} ${item.type}`.toLowerCase();
      if (!hay.includes(query)) return false;
    }

    if (category && item.type !== category) {
      return false;
    }

    if (params.newOnly && !item.isNew) {
      return false;
    }

    if (priceRange) {
      const parts = priceRange.split('-').map((n) => Number(n));
      if (parts.length === 2 && !Number.isNaN(parts[0]) && !Number.isNaN(parts[1])) {
        if (item.price < parts[0] || item.price > parts[1]) return false;
      } else if (parts.length === 1 && !Number.isNaN(parts[0])) {
        if (item.price < parts[0]) return false;
      }
    }

    return true;
  });
}

export interface PageResult<T> {
  items: T[];
  page: number;
  pageSize: number;
  total: number;
  totalPages: number;
}

export function paginateItems<T>(
  items: T[],
  requestedPage: number,
  pageSize: number,
): PageResult<T> {
  const safePageSize = Math.max(1, pageSize);
  const total = items.length;
  const totalPages = Math.max(1, Math.ceil(total / safePageSize));
  const page = Math.min(Math.max(1, Math.floor(requestedPage || 1)), totalPages);
  const start = (page - 1) * safePageSize;
  return {
    items: items.slice(start, start + safePageSize),
    page,
    pageSize: safePageSize,
    total,
    totalPages,
  };
}

export function formatRub(price: number): string {
  const rounded = Math.round(price * 100) / 100;
  return `${Number.isInteger(rounded) ? rounded : rounded.toFixed(2)} ₽`;
}

export function formatWeight(grams: number): string {
  if (grams >= 1000 && grams % 1000 === 0) {
    return `${grams / 1000} кг`;
  }
  return `${grams} г`;
}

export function formatRuDate(isoDate: string): string {
  const parsed = new Date(isoDate);
  if (Number.isNaN(parsed.getTime())) return isoDate;
  return new Intl.DateTimeFormat('ru-RU', {
    day: 'numeric',
    month: 'long',
    year: 'numeric',
  }).format(parsed);
}

export interface ValidationErrors {
  [field: string]: string;
}

const EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

export function validateContactForm(input: {
  name: string;
  email: string;
  subject: string;
  body: string;
}): ValidationErrors {
  const errors: ValidationErrors = {};
  if (!input.name.trim() || input.name.trim().length < 2) {
    errors.name = 'Укажите ваше имя (не менее 2 символов)';
  }
  if (!EMAIL_RE.test(input.email.trim())) {
    errors.email = 'Введите корректный адрес электронной почты';
  }
  if (!input.subject.trim() || input.subject.trim().length < 3) {
    errors.subject = 'Укажите тему обращения';
  }
  if (!input.body.trim() || input.body.trim().length < 10) {
    errors.body = 'Текст сообщения должен содержать не менее 10 символов';
  }
  return errors;
}

export function validateInquiryForm(input: {
  name: string;
  email: string;
  text: string;
}): ValidationErrors {
  const errors: ValidationErrors = {};
  if (!input.name.trim() || input.name.trim().length < 2) {
    errors.name = 'Укажите ваше имя';
  }
  if (!EMAIL_RE.test(input.email.trim())) {
    errors.email = 'Введите корректный e-mail';
  }
  if (!input.text.trim() || input.text.trim().length < 5) {
    errors.text = 'Напишите текст заявки (от 5 символов)';
  }
  return errors;
}

export function validateProductInput(input: {
  name: string;
  shortName: string;
  price: number;
  weight: number;
  description: string;
}): ValidationErrors {
  const errors: ValidationErrors = {};
  if (!input.name.trim() || input.name.trim().length < 2) {
    errors.name = 'Введите полное наименование продукции';
  }
  if (!input.shortName.trim() || input.shortName.trim().length > 35) {
    errors.shortName = 'Краткое наименование обязательно (до 35 символов)';
  }
  if (!Number.isFinite(input.price) || input.price <= 0) {
    errors.price = 'Укажите корректную цену больше 0';
  }
  if (!Number.isFinite(input.weight) || input.weight <= 0) {
    errors.weight = 'Укажите корректный вес в граммах';
  }
  if (!input.description.trim() || input.description.trim().length < 5) {
    errors.description = 'Добавьте описание продукции';
  }
  return errors;
}
