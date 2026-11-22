import test from 'node:test';
import assert from 'node:assert/strict';
import {
  filterProducts,
  paginateItems,
  formatRub,
  formatWeight,
  validateContactForm,
  validateInquiryForm,
  validateProductInput,
} from './catalog';
import type { Product } from './types';

const SAMPLE_PRODUCTS: Product[] = [
  {
    id: 1,
    name: 'Хлеб «Бородинский» заварной с кориандром',
    shortName: 'Хлеб Бородинский',
    price: 54,
    weight: 500,
    type: 'Хлеб',
    description: 'Традиционный ржано-пшеничный заварной хлеб с семенами кориандра.',
    image: '/images/products/rye_bread.jpg',
    isNew: true,
    isRecommend: true,
    published: true,
    createdAt: '2026-10-01T08:00:00Z',
    updatedAt: '2026-10-01T08:00:00Z',
  },
  {
    id: 2,
    name: 'Батон «Нарезной» классический',
    shortName: 'Батон Нарезной',
    price: 49,
    weight: 400,
    type: 'Батоны',
    description: 'Пшеничный батон из муки высшего сорта с золотистой корочкой.',
    image: '/images/products/golden_baton.jpg',
    isNew: false,
    isRecommend: true,
    published: true,
    createdAt: '2026-10-02T08:00:00Z',
    updatedAt: '2026-10-02T08:00:00Z',
  },
  {
    id: 3,
    name: 'Кекс «Столичный» с отборным изюмом',
    shortName: 'Кекс Столичный',
    price: 165,
    weight: 450,
    type: 'Кексы',
    description: 'Сдобный кекс на сливочном масле с изюмом и сахарной пудрой.',
    image: '/images/products/raisin_cake.jpg',
    isNew: true,
    isRecommend: false,
    published: true,
    createdAt: '2026-10-03T08:00:00Z',
    updatedAt: '2026-10-03T08:00:00Z',
  },
  {
    id: 4,
    name: 'Черновик: Сухари ванильные',
    shortName: 'Сухари черновик',
    price: 75,
    weight: 300,
    type: 'Сухари',
    description: 'Неопубликованная карточка товара.',
    image: '/images/products/baranki_rings.jpg',
    isNew: false,
    isRecommend: false,
    published: false,
    createdAt: '2026-10-04T08:00:00Z',
    updatedAt: '2026-10-04T08:00:00Z',
  },
];

test('filterProducts excludes unpublished items by default', () => {
  const result = filterProducts(SAMPLE_PRODUCTS, {});
  assert.equal(result.length, 3);
  assert.equal(result.some((p) => !p.published), false);
});

test('filterProducts filters by query, category, priceRange and newOnly', () => {
  assert.equal(filterProducts(SAMPLE_PRODUCTS, { query: 'кориандр' }).length, 1);
  assert.equal(filterProducts(SAMPLE_PRODUCTS, { category: 'Батоны' }).length, 1);
  assert.equal(filterProducts(SAMPLE_PRODUCTS, { newOnly: true }).length, 2);
  assert.equal(filterProducts(SAMPLE_PRODUCTS, { priceRange: '0-55' }).length, 2);
  assert.equal(filterProducts(SAMPLE_PRODUCTS, { priceRange: '141' }).length, 1);
  assert.equal(
    filterProducts(SAMPLE_PRODUCTS, { includeUnpublished: true }).length,
    4,
  );
});

test('paginateItems clamps out-of-bounds pages and slices cleanly', () => {
  const page1 = paginateItems(SAMPLE_PRODUCTS, 1, 2);
  assert.equal(page1.items.length, 2);
  assert.equal(page1.totalPages, 2);

  const clampedHigh = paginateItems(SAMPLE_PRODUCTS, 99, 2);
  assert.equal(clampedHigh.page, 2);
  assert.equal(clampedHigh.items[0].id, 3);

  const clampedLow = paginateItems(SAMPLE_PRODUCTS, -3, 2);
  assert.equal(clampedLow.page, 1);
});

test('formatRub and formatWeight format values cleanly', () => {
  assert.equal(formatRub(54), '54 ₽');
  assert.equal(formatRub(54.5), '54.50 ₽');
  assert.equal(formatWeight(450), '450 г');
  assert.equal(formatWeight(1000), '1 кг');
});

test('validateContactForm rejects empty or invalid fields and accepts valid input', () => {
  const bad = validateContactForm({ name: 'А', email: 'not-an-email', subject: '', body: 'коротко' });
  assert.ok(bad.name);
  assert.ok(bad.email);
  assert.ok(bad.subject);
  assert.ok(bad.body);

  const good = validateContactForm({
    name: 'Иван Петров',
    email: 'ivan@example.ru',
    subject: 'Запрос оптового прайса',
    body: 'Просим направить актуальный прайс-лист на хлебобулочные изделия.',
  });
  assert.equal(Object.keys(good).length, 0);
});

test('validateInquiryForm and validateProductInput catch invalid values', () => {
  const badInquiry = validateInquiryForm({ name: '', email: 'bad', text: 'ок' });
  assert.equal(Object.keys(badInquiry).length, 3);

  const badProduct = validateProductInput({
    name: '',
    shortName: 'Очень длинное краткое название которое превышает лимит тридцати пяти знаков',
    price: 0,
    weight: -50,
    description: '123',
  });
  assert.equal(Object.keys(badProduct).length, 5);
});
