import crypto from 'node:crypto';
import fs from 'node:fs/promises';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import express, { type Request, type Response, type NextFunction } from 'express';
import {
  SEED_AWARDS,
  SEED_INQUIRIES,
  SEED_NEWS,
  SEED_PRODUCTS,
  SEED_USER,
  SEED_VACANCIES,
} from './src/lib/seedData.ts';
import {
  filterProducts,
  validateContactForm,
  validateInquiryForm,
  validateProductInput,
} from './src/lib/catalog.ts';
import {
  PRODUCT_CATEGORIES,
  type AwardItem,
  type InquiryRecord,
  type NewsItem,
  type Product,
  type ProductCategory,
  type UserProfile,
  type VacancyItem,
} from './src/lib/types.ts';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const PORT = Number(process.env.PORT || 3000);
const IS_PROD = process.env.NODE_ENV === 'production';

// In-memory store seeded with authentic JSC Kamyshin Breadfactory records
const state: {
  products: Product[];
  news: NewsItem[];
  vacancies: VacancyItem[];
  awards: AwardItem[];
  inquiries: InquiryRecord[];
  user: UserProfile;
  passwordHash: string;
  sessions: Set<string>;
} = {
  products: structuredClone(SEED_PRODUCTS),
  news: structuredClone(SEED_NEWS),
  vacancies: structuredClone(SEED_VACANCIES),
  awards: structuredClone(SEED_AWARDS),
  inquiries: structuredClone(SEED_INQUIRIES),
  user: structuredClone(SEED_USER),
  passwordHash: hashPassword('admin2026'),
  sessions: new Set<string>(),
};

function hashPassword(password: string): string {
  return crypto.createHash('sha256').update(`kambread-2026:${password}`).digest('hex');
}

function nextId<T extends { id: number }>(list: T[]): number {
  return list.reduce((max, item) => Math.max(max, item.id), 0) + 1;
}

function extractToken(req: Request): string | null {
  const header = req.header('authorization') ?? '';
  if (!header.startsWith('Bearer ')) return null;
  return header.slice(7).trim() || null;
}

function isAuthenticated(req: Request): boolean {
  const token = extractToken(req);
  return Boolean(token && state.sessions.has(token));
}

function requireAuth(req: Request, res: Response, next: NextFunction): void {
  if (!isAuthenticated(req)) {
    res.status(401).json({ error: 'Требуется авторизация' });
    return;
  }
  next();
}

function asCategory(value: unknown): ProductCategory {
  if (typeof value === 'string' && (PRODUCT_CATEGORIES as readonly string[]).includes(value)) {
    return value as ProductCategory;
  }
  return 'Хлеб';
}

async function startServer() {
  const app = express();
  app.use(express.json({ limit: '2mb' }));

  // Serve copied authentic & generated static assets directly
  app.use('/images', express.static(path.resolve(__dirname, 'public/images')));
  app.use('/favicon.ico', express.static(path.resolve(__dirname, 'public/favicon.ico')));

  // --- Health ---
  app.get('/api/health', (_req, res) => {
    res.json({ ok: true, service: 'kamyshin-breadfactory', version: '2026.11.0' });
  });

  // --- Auth & Profile ---
  app.post('/api/auth/login', (req, res) => {
    const username = String(req.body?.username ?? '').trim();
    const password = String(req.body?.password ?? '');
    if (!username || !password) {
      res.status(400).json({ error: 'Введите логин и пароль' });
      return;
    }
    if (
      username.toLowerCase() !== state.user.username.toLowerCase() ||
      hashPassword(password) !== state.passwordHash
    ) {
      res.status(401).json({ error: 'Неверное имя пользователя или пароль' });
      return;
    }
    const token = crypto.randomBytes(24).toString('hex');
    state.sessions.add(token);
    state.user.lastLoginAt = new Date().toISOString();
    res.json({ token, user: state.user });
  });

  app.post('/api/auth/logout', (req, res) => {
    const token = extractToken(req);
    if (token) state.sessions.delete(token);
    res.json({ ok: true });
  });

  app.get('/api/auth/me', (req, res) => {
    if (!isAuthenticated(req)) {
      res.status(401).json({ error: 'Не авторизован' });
      return;
    }
    res.json({ user: state.user });
  });

  app.put('/api/profile', requireAuth, (req, res) => {
    const name = String(req.body?.name ?? '').trim();
    const email = String(req.body?.email ?? '').trim();
    const phone = String(req.body?.phone ?? '').trim();
    if (name.length < 2 || !email.includes('@')) {
      res.status(400).json({ error: 'Проверьте имя и корректность e-mail' });
      return;
    }
    state.user = { ...state.user, name, email, phone };
    res.json({ user: state.user });
  });

  app.post('/api/profile/password', requireAuth, (req, res) => {
    const currentPassword = String(req.body?.currentPassword ?? '');
    const newPassword = String(req.body?.newPassword ?? '');
    if (hashPassword(currentPassword) !== state.passwordHash) {
      res.status(400).json({ error: 'Текущий пароль указан неверно' });
      return;
    }
    if (newPassword.length < 6) {
      res.status(400).json({ error: 'Новый пароль должен содержать не менее 6 символов' });
      return;
    }
    state.passwordHash = hashPassword(newPassword);
    res.json({ ok: true });
  });

  // --- Products ---
  app.get('/api/products', (req, res) => {
    const includeUnpublished = req.query.all === '1' && isAuthenticated(req);
    const items = filterProducts(state.products, {
      query: typeof req.query.q === 'string' ? req.query.q : '',
      priceRange: typeof req.query.price === 'string' ? req.query.price : '',
      category: typeof req.query.type === 'string' ? req.query.type : '',
      newOnly: req.query.new === '1',
      includeUnpublished,
    }).sort((a, b) => b.id - a.id);

    res.json({ items, total: items.length });
  });

  app.get('/api/products/:id', (req, res) => {
    const id = Number(req.params.id);
    const product = state.products.find((p) => p.id === id);
    if (!product || (!product.published && !isAuthenticated(req))) {
      res.status(404).json({ error: 'Продукция не найдена' });
      return;
    }
    res.json({ item: product });
  });

  app.post('/api/products', requireAuth, (req, res) => {
    const payload = {
      name: String(req.body?.name ?? '').trim(),
      shortName: String(req.body?.shortName ?? '').trim(),
      price: Number(req.body?.price),
      weight: Number(req.body?.weight),
      description: String(req.body?.description ?? '').trim(),
    };
    const errors = validateProductInput(payload);
    if (Object.keys(errors).length > 0) {
      res.status(400).json({ error: Object.values(errors)[0], errors });
      return;
    }
    const now = new Date().toISOString();
    const created: Product = {
      id: nextId(state.products),
      ...payload,
      type: asCategory(req.body?.type),
      image: String(req.body?.image ?? '').trim() || '/images/products/rye_bread.jpg',
      isNew: Boolean(req.body?.isNew),
      isRecommend: Boolean(req.body?.isRecommend),
      published: req.body?.published !== false,
      createdAt: now,
      updatedAt: now,
    };
    state.products.unshift(created);
    res.status(201).json({ item: created });
  });

  app.put('/api/products/:id', requireAuth, (req, res) => {
    const id = Number(req.params.id);
    const index = state.products.findIndex((p) => p.id === id);
    if (index === -1) {
      res.status(404).json({ error: 'Продукция не найдена' });
      return;
    }
    const current = state.products[index];
    const payload = {
      name: req.body?.name !== undefined ? String(req.body.name).trim() : current.name,
      shortName: req.body?.shortName !== undefined ? String(req.body.shortName).trim() : current.shortName,
      price: req.body?.price !== undefined ? Number(req.body.price) : current.price,
      weight: req.body?.weight !== undefined ? Number(req.body.weight) : current.weight,
      description:
        req.body?.description !== undefined ? String(req.body.description).trim() : current.description,
    };
    const errors = validateProductInput(payload);
    if (Object.keys(errors).length > 0) {
      res.status(400).json({ error: Object.values(errors)[0], errors });
      return;
    }
    const updated: Product = {
      ...current,
      ...payload,
      type: req.body?.type !== undefined ? asCategory(req.body.type) : current.type,
      image: req.body?.image !== undefined ? String(req.body.image).trim() || current.image : current.image,
      isNew: req.body?.isNew !== undefined ? Boolean(req.body.isNew) : current.isNew,
      isRecommend: req.body?.isRecommend !== undefined ? Boolean(req.body.isRecommend) : current.isRecommend,
      published: req.body?.published !== undefined ? Boolean(req.body.published) : current.published,
      updatedAt: new Date().toISOString(),
    };
    state.products[index] = updated;
    res.json({ item: updated });
  });

  app.delete('/api/products/:id', requireAuth, (req, res) => {
    const id = Number(req.params.id);
    const before = state.products.length;
    state.products = state.products.filter((p) => p.id !== id);
    if (state.products.length === before) {
      res.status(404).json({ error: 'Продукция не найдена' });
      return;
    }
    res.json({ ok: true });
  });

  // --- News ---
  app.get('/api/news', (req, res) => {
    const includeAll = req.query.all === '1' && isAuthenticated(req);
    const items = state.news
      .filter((n) => includeAll || n.published)
      .sort((a, b) => b.createdAt.localeCompare(a.createdAt));
    res.json({ items, total: items.length });
  });

  app.get('/api/news/:id', (req, res) => {
    const id = Number(req.params.id);
    const item = state.news.find((n) => n.id === id);
    if (!item || (!item.published && !isAuthenticated(req))) {
      res.status(404).json({ error: 'Новость не найдена' });
      return;
    }
    res.json({ item });
  });

  app.post('/api/news', requireAuth, (req, res) => {
    const title = String(req.body?.title ?? '').trim();
    const description = String(req.body?.description ?? '').trim();
    if (title.length < 3 || description.length < 10) {
      res.status(400).json({ error: 'Укажите заголовок (от 3 символов) и текст новости' });
      return;
    }
    const now = new Date().toISOString();
    const created: NewsItem = {
      id: nextId(state.news),
      title,
      description,
      image: String(req.body?.image ?? '').trim() || '/images/slider/2.jpg',
      gallery: [],
      published: req.body?.published !== false,
      createdAt: now,
      updatedAt: now,
      comments: [],
    };
    state.news.unshift(created);
    res.status(201).json({ item: created });
  });

  app.put('/api/news/:id', requireAuth, (req, res) => {
    const id = Number(req.params.id);
    const index = state.news.findIndex((n) => n.id === id);
    if (index === -1) {
      res.status(404).json({ error: 'Новость не найдена' });
      return;
    }
    const current = state.news[index];
    const title = req.body?.title !== undefined ? String(req.body.title).trim() : current.title;
    const description =
      req.body?.description !== undefined ? String(req.body.description).trim() : current.description;
    if (title.length < 3 || description.length < 10) {
      res.status(400).json({ error: 'Укажите корректный заголовок и текст новости' });
      return;
    }
    state.news[index] = {
      ...current,
      title,
      description,
      image: req.body?.image !== undefined ? String(req.body.image).trim() || current.image : current.image,
      published: req.body?.published !== undefined ? Boolean(req.body.published) : current.published,
      updatedAt: new Date().toISOString(),
    };
    res.json({ item: state.news[index] });
  });

  app.delete('/api/news/:id', requireAuth, (req, res) => {
    const id = Number(req.params.id);
    const before = state.news.length;
    state.news = state.news.filter((n) => n.id !== id);
    if (state.news.length === before) {
      res.status(404).json({ error: 'Новость не найдена' });
      return;
    }
    res.json({ ok: true });
  });

  app.post('/api/news/:id/comments', (req, res) => {
    const id = Number(req.params.id);
    const item = state.news.find((n) => n.id === id);
    if (!item) {
      res.status(404).json({ error: 'Новость не найдена' });
      return;
    }
    const author = String(req.body?.author ?? '').trim();
    const body = String(req.body?.body ?? '').trim();
    if (author.length < 2 || body.length < 4) {
      res.status(400).json({ error: 'Укажите имя и текст комментария' });
      return;
    }
    const comment = {
      id: nextId(item.comments),
      author,
      body,
      createdAt: new Date().toISOString(),
    };
    item.comments.push(comment);
    res.status(201).json({ comment });
  });

  // --- Vacancies ---
  app.get('/api/vacancies', (req, res) => {
    const includeClosed = req.query.all === '1' && isAuthenticated(req);
    const items = state.vacancies
      .filter((v) => includeClosed || v.open)
      .sort((a, b) => b.updatedAt.localeCompare(a.updatedAt));
    res.json({ items, total: items.length });
  });

  app.post('/api/vacancies', requireAuth, (req, res) => {
    const title = String(req.body?.title ?? '').trim();
    const description = String(req.body?.description ?? '').trim();
    if (title.length < 3 || description.length < 10) {
      res.status(400).json({ error: 'Укажите название вакансии и описание' });
      return;
    }
    const now = new Date().toISOString();
    const created: VacancyItem = {
      id: nextId(state.vacancies),
      title,
      department: String(req.body?.department ?? '').trim() || 'Производственный отдел',
      schedule: String(req.body?.schedule ?? '').trim() || 'Полный день',
      description,
      open: req.body?.open !== false,
      createdAt: now,
      updatedAt: now,
    };
    state.vacancies.unshift(created);
    res.status(201).json({ item: created });
  });

  app.put('/api/vacancies/:id', requireAuth, (req, res) => {
    const id = Number(req.params.id);
    const index = state.vacancies.findIndex((v) => v.id === id);
    if (index === -1) {
      res.status(404).json({ error: 'Вакансия не найдена' });
      return;
    }
    const current = state.vacancies[index];
    state.vacancies[index] = {
      ...current,
      title: req.body?.title !== undefined ? String(req.body.title).trim() : current.title,
      department:
        req.body?.department !== undefined ? String(req.body.department).trim() : current.department,
      schedule: req.body?.schedule !== undefined ? String(req.body.schedule).trim() : current.schedule,
      description:
        req.body?.description !== undefined ? String(req.body.description).trim() : current.description,
      open: req.body?.open !== undefined ? Boolean(req.body.open) : current.open,
      updatedAt: new Date().toISOString(),
    };
    res.json({ item: state.vacancies[index] });
  });

  app.delete('/api/vacancies/:id', requireAuth, (req, res) => {
    const id = Number(req.params.id);
    const before = state.vacancies.length;
    state.vacancies = state.vacancies.filter((v) => v.id !== id);
    if (state.vacancies.length === before) {
      res.status(404).json({ error: 'Вакансия не найдена' });
      return;
    }
    res.json({ ok: true });
  });

  // --- Awards ---
  app.get('/api/awards', (_req, res) => {
    const items = [...state.awards].sort((a, b) => b.year - a.year);
    res.json({ items, total: items.length });
  });

  app.post('/api/awards', requireAuth, (req, res) => {
    const year = Number(req.body?.year);
    const description = String(req.body?.description ?? '').trim();
    if (!Number.isInteger(year) || year < 1956 || year > 2030 || description.length < 5) {
      res.status(400).json({ error: 'Укажите год (1956–2030) и описание награды' });
      return;
    }
    const created: AwardItem = {
      id: nextId(state.awards),
      year,
      description,
      image: String(req.body?.image ?? '').trim() || '/images/about/watermelon.jpg',
    };
    state.awards.unshift(created);
    res.status(201).json({ item: created });
  });

  app.delete('/api/awards/:id', requireAuth, (req, res) => {
    const id = Number(req.params.id);
    const before = state.awards.length;
    state.awards = state.awards.filter((a) => a.id !== id);
    if (state.awards.length === before) {
      res.status(404).json({ error: 'Награда не найдена' });
      return;
    }
    res.json({ ok: true });
  });

  // --- Contact & Product Inquiries ---
  app.post('/api/contact', (req, res) => {
    const input = {
      name: String(req.body?.name ?? '').trim(),
      email: String(req.body?.email ?? '').trim(),
      subject: String(req.body?.subject ?? '').trim(),
      body: String(req.body?.body ?? '').trim(),
    };
    const errors = validateContactForm(input);
    if (Object.keys(errors).length > 0) {
      res.status(400).json({ error: Object.values(errors)[0], errors });
      return;
    }
    const record: InquiryRecord = {
      id: nextId(state.inquiries),
      kind: 'contact',
      ...input,
      createdAt: new Date().toISOString(),
    };
    state.inquiries.unshift(record);
    res.status(201).json({ item: record, message: 'Сообщение успешно отправлено' });
  });

  app.post('/api/inquiries', (req, res) => {
    const input = {
      name: String(req.body?.name ?? '').trim(),
      email: String(req.body?.email ?? '').trim(),
      text: String(req.body?.text ?? '').trim(),
    };
    const errors = validateInquiryForm(input);
    if (Object.keys(errors).length > 0) {
      res.status(400).json({ error: Object.values(errors)[0], errors });
      return;
    }
    const productId = req.body?.productId ? Number(req.body.productId) : undefined;
    const product = productId ? state.products.find((p) => p.id === productId) : undefined;
    const record: InquiryRecord = {
      id: nextId(state.inquiries),
      kind: 'product',
      productId: product?.id,
      productName: product?.name,
      name: input.name,
      email: input.email,
      subject: product ? `Заявка по продукции: ${product.shortName}` : 'Заявка по продукции',
      body: input.text,
      createdAt: new Date().toISOString(),
    };
    state.inquiries.unshift(record);
    res.status(201).json({ item: record, message: 'Заявка успешно отправлена в отдел маркетинга' });
  });

  app.get('/api/inquiries', requireAuth, (_req, res) => {
    res.json({ items: state.inquiries, total: state.inquiries.length });
  });

  // Unknown API route returns JSON 404
  app.use('/api', (_req, res) => {
    res.status(404).json({ error: 'API route not found' });
  });

  // --- Frontend Serving (Vite middleware in dev, static dist in prod) ---
  if (!IS_PROD) {
    const { createServer: createViteServer } = await import('vite');
    const vite = await createViteServer({
      server: { middlewareMode: true, hmr: process.env.DISABLE_HMR !== 'true' },
      appType: 'spa',
    });
    app.use(vite.middlewares);
  } else {
    const distDir = path.resolve(__dirname, 'dist');
    app.use(express.static(distDir));
    app.use(async (_req, res) => {
      const html = await fs.readFile(path.join(distDir, 'index.html'), 'utf-8');
      res.status(200).set({ 'Content-Type': 'text/html' }).end(html);
    });
  }

  app.listen(PORT, '0.0.0.0', () => {
    console.log(`JSC Kamyshin Breadfactory server running on http://0.0.0.0:${PORT}`);
  });
}

startServer().catch((err) => {
  console.error('Failed to start server:', err);
  process.exit(1);
});
