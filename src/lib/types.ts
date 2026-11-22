export const PRODUCT_CATEGORIES = [
  'Хлеб',
  'Батоны',
  'Булочки',
  'Баранки',
  'Кексы',
  'Сухари',
  'Эксклюзивная',
] as const;

export type ProductCategory = (typeof PRODUCT_CATEGORIES)[number];

export interface Product {
  id: number;
  name: string;
  shortName: string;
  price: number;
  weight: number;
  type: ProductCategory;
  description: string;
  image: string;
  isNew: boolean;
  isRecommend: boolean;
  published: boolean;
  createdAt: string;
  updatedAt: string;
}

export interface NewsComment {
  id: number;
  author: string;
  body: string;
  createdAt: string;
}

export interface NewsItem {
  id: number;
  title: string;
  description: string;
  image: string;
  gallery: string[];
  published: boolean;
  createdAt: string;
  updatedAt: string;
  comments: NewsComment[];
}

export interface VacancyItem {
  id: number;
  title: string;
  department: string;
  schedule: string;
  description: string;
  open: boolean;
  createdAt: string;
  updatedAt: string;
}

export interface AwardItem {
  id: number;
  year: number;
  description: string;
  image: string;
}

export interface InquiryRecord {
  id: number;
  kind: 'product' | 'contact';
  productId?: number;
  productName?: string;
  name: string;
  email: string;
  subject: string;
  body: string;
  createdAt: string;
}

export interface UserProfile {
  id: number;
  username: string;
  name: string;
  email: string;
  phone: string;
  role: string;
  lastLoginAt: string;
}

export interface ProductFilterParams {
  query?: string;
  priceRange?: string;
  category?: string;
  newOnly?: boolean;
  includeUnpublished?: boolean;
}
