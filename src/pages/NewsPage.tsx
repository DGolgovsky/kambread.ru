import { useEffect, useState, type FormEvent } from 'react';
import { Link, useParams } from 'react-router-dom';
import { ArrowLeft, ArrowRight } from 'lucide-react';
import { apiFetch } from '../lib/api';
import { formatRuDate } from '../lib/catalog';
import type { NewsComment, NewsItem } from '../lib/types';
import { PageBanner } from '../components/Layout';
import { SafeImage } from '../components/SafeImage';

export function NewsListPage() {
  const [items, setItems] = useState<NewsItem[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    let active = true;
    apiFetch<{ items: NewsItem[] }>('/api/news')
      .then((res) => {
        if (active) setItems(res.items);
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
        title="Новости"
        subtitle="События производства, выпуск новинок и участие в городских праздниках."
        crumbs={[{ label: 'Новости' }]}
      />

      <div className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {loading ? (
          <div className="space-y-6">
            {Array.from({ length: 3 }).map((_, idx) => (
              <div key={idx} className="h-44 rounded-xl bg-[#EFE9E0] animate-pulse" />
            ))}
          </div>
        ) : items.length === 0 ? (
          <div className="bg-white border border-[#E5DDD3] rounded-xl p-10 text-center text-sm text-[#5C534A]">
            Новостей пока нет.
          </div>
        ) : (
          <div className="space-y-6">
            {items.map((item) => (
              <article
                key={item.id}
                className="bg-white border border-[#E5DDD3] rounded-xl overflow-hidden grid grid-cols-1 md:grid-cols-12"
              >
                <Link
                  to={`/news/${item.id}`}
                  className="md:col-span-4 aspect-[4/3] md:aspect-auto bg-[#F3EFE8] overflow-hidden block"
                >
                  <SafeImage
                    src={item.image}
                    alt={item.title}
                    className="w-full h-full object-cover hover:scale-[1.03] transition-transform duration-300"
                  />
                </Link>
                <div className="md:col-span-8 p-6 flex flex-col justify-between">
                  <div>
                    <time className="block text-xs text-[#786D62] mb-2 tabular-nums">
                      Опубликовано: {formatRuDate(item.createdAt)}
                    </time>
                    <h2 className="font-display text-2xl font-semibold text-[#1F1915] leading-snug mb-3">
                      <Link
                        to={`/news/${item.id}`}
                        className="hover:text-[#B82D25] transition-colors"
                      >
                        {item.title}
                      </Link>
                    </h2>
                    <p className="text-sm text-[#5C534A] leading-relaxed line-clamp-3">
                      {item.description}
                    </p>
                  </div>
                  <div className="mt-5 pt-4 border-t border-[#EFE8DF]">
                    <Link
                      to={`/news/${item.id}`}
                      className="inline-flex items-center gap-1.5 text-sm font-medium text-[#B82D25] hover:text-[#93211A]"
                    >
                      Читать полностью
                      <ArrowRight className="w-4 h-4" aria-hidden="true" />
                    </Link>
                  </div>
                </div>
              </article>
            ))}
          </div>
        )}
      </div>
    </div>
  );
}

export function NewsDetailPage() {
  const { id } = useParams();
  const [article, setArticle] = useState<NewsItem | null>(null);
  const [loading, setLoading] = useState(true);
  const [activePhoto, setActivePhoto] = useState(0);

  const [author, setAuthor] = useState('');
  const [commentBody, setCommentBody] = useState('');
  const [commentError, setCommentError] = useState<string | null>(null);
  const [submitting, setSubmitting] = useState(false);

  useEffect(() => {
    let active = true;
    setLoading(true);
    setActivePhoto(0);
    apiFetch<{ item: NewsItem }>(`/api/news/${id}`)
      .then((res) => {
        if (active) setArticle(res.item);
      })
      .catch(() => {
        if (active) setArticle(null);
      })
      .finally(() => {
        if (active) setLoading(false);
      });
    return () => {
      active = false;
    };
  }, [id]);

  const handleComment = async (e: FormEvent) => {
    e.preventDefault();
    if (!article) return;
    setCommentError(null);
    if (author.trim().length < 2 || commentBody.trim().length < 4) {
      setCommentError('Укажите имя (от 2 символов) и текст комментария');
      return;
    }
    setSubmitting(true);
    try {
      const res = await apiFetch<{ comment: NewsComment }>(
        `/api/news/${article.id}/comments`,
        {
          method: 'POST',
          body: JSON.stringify({ author, body: commentBody }),
        },
      );
      setArticle({
        ...article,
        comments: [...article.comments, res.comment],
      });
      setAuthor('');
      setCommentBody('');
    } catch (err) {
      setCommentError(err instanceof Error ? err.message : 'Ошибка добавления комментария');
    } finally {
      setSubmitting(false);
    }
  };

  if (loading) {
    return (
      <div className="max-w-5xl mx-auto px-4 py-16">
        <div className="h-96 rounded-xl bg-[#EFE9E0] animate-pulse" />
      </div>
    );
  }

  if (!article) {
    return (
      <div className="max-w-3xl mx-auto px-4 py-20 text-center">
        <h1 className="font-display text-3xl text-[#1F1915] mb-4">Новость не найдена</h1>
        <Link
          to="/news"
          className="inline-flex items-center gap-2 px-5 py-2.5 rounded-md bg-[#B82D25] text-white text-sm font-medium"
        >
          <ArrowLeft className="w-4 h-4" />
          Все новости
        </Link>
      </div>
    );
  }

  const photos = [article.image, ...article.gallery].filter(Boolean);

  return (
    <div>
      <PageBanner
        title={article.title}
        crumbs={[
          { label: 'Новости', to: '/news' },
          { label: 'Просмотр новости' },
        ]}
      />

      <div className="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-10">
          <article className="lg:col-span-8 space-y-6">
            <time className="block text-sm text-[#786D62] tabular-nums">
              Создано: {formatRuDate(article.createdAt)}
            </time>

            <div className="aspect-[16/10] rounded-xl overflow-hidden border border-[#E5DDD3] bg-[#F3EFE8]">
              <SafeImage
                src={photos[activePhoto] ?? article.image}
                alt={article.title}
                className="w-full h-full object-cover"
              />
            </div>

            {photos.length > 1 && (
              <div className="flex items-center gap-3 overflow-x-auto pb-1">
                {photos.map((photo, idx) => (
                  <button
                    key={`${photo}-${idx}`}
                    type="button"
                    onClick={() => setActivePhoto(idx)}
                    aria-label={`Фотография ${idx + 1}`}
                    className={`w-24 h-16 rounded-lg overflow-hidden border-2 shrink-0 transition-colors ${
                      idx === activePhoto ? 'border-[#B82D25]' : 'border-[#E5DDD3] opacity-75 hover:opacity-100'
                    }`}
                  >
                    <SafeImage src={photo} alt="" className="w-full h-full object-cover" />
                  </button>
                ))}
              </div>
            )}

            <div className="bg-white border border-[#E5DDD3] rounded-xl p-6 sm:p-8 text-base text-[#3D352E] leading-relaxed whitespace-pre-line">
              {article.description}
            </div>
          </article>

          {/* Native comments section replacing legacy HyperComments */}
          <aside className="lg:col-span-4 space-y-6">
            <div className="bg-white border border-[#E5DDD3] rounded-xl p-6">
              <h2 className="font-display text-xl font-semibold text-[#1F1915] mb-4">
                Комментарии ({article.comments.length})
              </h2>

              {article.comments.length === 0 ? (
                <p className="text-sm text-[#6B6056] mb-5">
                  Пока нет комментариев. Поделитесь вашим мнением о новости.
                </p>
              ) : (
                <div className="space-y-4 mb-6 divide-y divide-[#EFE8DF]">
                  {article.comments.map((c) => (
                    <div key={c.id} className="pt-4 first:pt-0">
                      <div className="flex items-baseline justify-between gap-2 mb-1">
                        <span className="text-sm font-semibold text-[#1F1915]">{c.author}</span>
                        <time className="text-xs text-[#786D62] tabular-nums">
                          {formatRuDate(c.createdAt)}
                        </time>
                      </div>
                      <p className="text-sm text-[#3D352E] leading-relaxed">{c.body}</p>
                    </div>
                  ))}
                </div>
              )}

              <form onSubmit={handleComment} className="space-y-3 pt-4 border-t border-[#EFE8DF]">
                <div>
                  <label htmlFor="comment-author" className="block text-xs font-medium text-[#5C534A] mb-1">
                    Ваше имя
                  </label>
                  <input
                    id="comment-author"
                    type="text"
                    value={author}
                    onChange={(e) => setAuthor(e.target.value)}
                    placeholder="Как к вам обращаться"
                    className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md focus:outline-none focus:ring-2 focus:ring-[#B82D25]"
                  />
                </div>
                <div>
                  <label htmlFor="comment-body" className="block text-xs font-medium text-[#5C534A] mb-1">
                    Комментарий
                  </label>
                  <textarea
                    id="comment-body"
                    rows={3}
                    value={commentBody}
                    onChange={(e) => setCommentBody(e.target.value)}
                    placeholder="Напишите отзыв или вопрос..."
                    className="w-full px-3 py-2 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md focus:outline-none focus:ring-2 focus:ring-[#B82D25]"
                  />
                </div>
                {commentError && <p className="text-xs text-red-700">{commentError}</p>}
                <button
                  type="submit"
                  disabled={submitting}
                  className="w-full py-2.5 px-4 rounded-md bg-[#1F1915] text-white text-sm font-medium hover:bg-[#362C25] disabled:opacity-60 transition-colors"
                >
                  {submitting ? 'Публикация...' : 'Оставить комментарий'}
                </button>
              </form>
            </div>
          </aside>
        </div>
      </div>
    </div>
  );
}
