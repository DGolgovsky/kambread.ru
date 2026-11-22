import { useEffect } from 'react';
import { BrowserRouter, Navigate, Route, Routes, useLocation } from 'react-router-dom';
import { AuthProvider } from './context/AuthContext';
import { Layout } from './components/Layout';
import { HomePage } from './pages/HomePage';
import { ProductsPage } from './pages/ProductsPage';
import { ProductDetailPage } from './pages/ProductDetailPage';
import { AboutPage } from './pages/AboutPage';
import { PartnersPage } from './pages/PartnersPage';
import { VacanciesPage } from './pages/VacanciesPage';
import { NewsDetailPage, NewsListPage } from './pages/NewsPage';
import { ContactPage } from './pages/ContactPage';
import { LoginPage } from './pages/LoginPage';
import { CabinetPage } from './pages/CabinetPage';
import { NotFoundPage } from './pages/NotFoundPage';

function ScrollToTop() {
  const { pathname } = useLocation();
  useEffect(() => {
    window.scrollTo(0, 0);
  }, [pathname]);
  return null;
}

export function App() {
  return (
    <AuthProvider>
      <BrowserRouter>
        <ScrollToTop />
        <Layout>
          <Routes>
            <Route path="/" element={<HomePage />} />
            <Route path="/products" element={<ProductsPage />} />
            <Route path="/products/:id" element={<ProductDetailPage />} />
            <Route path="/about" element={<AboutPage />} />
            <Route path="/partners" element={<PartnersPage />} />
            <Route path="/vacancies" element={<VacanciesPage />} />
            <Route path="/news" element={<NewsListPage />} />
            <Route path="/news/:id" element={<NewsDetailPage />} />
            <Route path="/contact" element={<ContactPage />} />
            <Route path="/login" element={<LoginPage />} />
            <Route path="/cabinet" element={<CabinetPage />} />

            {/* Legacy Yii2 route aliases */}
            <Route path="/site/about" element={<Navigate to="/about" replace />} />
            <Route path="/site/partners" element={<Navigate to="/partners" replace />} />
            <Route path="/site/contact" element={<Navigate to="/contact" replace />} />
            <Route path="/site/login" element={<Navigate to="/login" replace />} />
            <Route path="/vacancy" element={<Navigate to="/vacancies" replace />} />
            <Route path="/cabinet/*" element={<Navigate to="/cabinet" replace />} />

            <Route path="*" element={<NotFoundPage />} />
          </Routes>
        </Layout>
      </BrowserRouter>
    </AuthProvider>
  );
}

export default App;
