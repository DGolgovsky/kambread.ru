import { useState, type FormEvent } from 'react';
import { Navigate, useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import { PageBanner } from '../components/Layout';

export function LoginPage() {
  const { user, login } = useAuth();
  const navigate = useNavigate();

  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState<string | null>(null);
  const [submitting, setSubmitting] = useState(false);

  if (user) {
    return <Navigate to="/cabinet" replace />;
  }

  const handleSubmit = async (e: FormEvent) => {
    e.preventDefault();
    setError(null);
    if (!username.trim() || !password) {
      setError('Введите логин и пароль');
      return;
    }
    setSubmitting(true);
    try {
      await login(username, password);
      navigate('/cabinet');
    } catch (err) {
      setError(err instanceof Error ? err.message : 'Ошибка авторизации');
    } finally {
      setSubmitting(false);
    }
  };

  const fillDemo = () => {
    setUsername('admin');
    setPassword('admin2026');
    setError(null);
  };

  return (
    <div>
      <PageBanner
        title="Авторизация"
        subtitle="Вход в личный кабинет управления продукцией, новостями, вакансиями и наградами."
        crumbs={[{ label: 'Авторизация' }]}
      />

      <div className="max-w-md mx-auto px-4 sm:px-6 py-14">
        <div className="bg-white border border-[#E5DDD3] rounded-xl p-6 sm:p-8">
          <h2 className="font-display text-2xl font-semibold text-[#1F1915] mb-2">
            Вход для сотрудников
          </h2>
          <p className="text-sm text-[#5C534A] mb-6">
            Заполните поля ниже для доступа к редакторскому кабинету.
          </p>

          <form onSubmit={handleSubmit} className="space-y-4">
            <div>
              <label htmlFor="login-username" className="block text-xs font-medium text-[#5C534A] mb-1">
                Имя пользователя
              </label>
              <input
                id="login-username"
                type="text"
                autoComplete="username"
                value={username}
                onChange={(e) => setUsername(e.target.value)}
                placeholder="admin"
                className="w-full px-3.5 py-2.5 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md focus:outline-none focus:ring-2 focus:ring-[#B82D25]"
              />
            </div>

            <div>
              <label htmlFor="login-password" className="block text-xs font-medium text-[#5C534A] mb-1">
                Пароль
              </label>
              <input
                id="login-password"
                type="password"
                autoComplete="current-password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                placeholder="••••••••"
                className="w-full px-3.5 py-2.5 text-sm bg-[#FAF8F5] border border-[#DDD3C7] rounded-md focus:outline-none focus:ring-2 focus:ring-[#B82D25]"
              />
            </div>

            {error && (
              <p role="alert" className="text-xs text-red-700 bg-red-50 border border-red-200 rounded-md p-2.5">
                {error}
              </p>
            )}

            <button
              type="submit"
              disabled={submitting}
              className="w-full py-3 px-4 rounded-md bg-[#B82D25] text-white text-sm font-medium hover:bg-[#93211A] disabled:opacity-60 transition-colors"
            >
              {submitting ? 'Выполняется вход...' : 'Войти'}
            </button>
          </form>

          <div className="mt-6 pt-5 border-t border-[#EFE8DF] flex items-center justify-between gap-3 text-xs text-[#5C534A]">
            <span>
              Демо-доступ: <strong className="text-[#1F1915]">admin</strong> /{' '}
              <strong className="text-[#1F1915]">admin2026</strong>
            </span>
            <button
              type="button"
              onClick={fillDemo}
              className="text-[#B82D25] font-medium hover:underline whitespace-nowrap shrink-0"
            >
              Подставить
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}
