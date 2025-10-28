<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club do Cookie - Uma explosão de sabores</title>
    <style>
        body {
            box-sizing: border-box;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #1C0E05;
            color: #E5B273;
            line-height: 1.6;
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(28, 14, 5, 0.95);
            backdrop-filter: blur(10px);
            z-index: 1000;
            padding: 1rem 2rem;
            border-bottom: 1px solid rgba(200, 138, 50, 0.2);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            color: #C88A32;
            text-decoration: none;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .nav-menu a {
            color: #E5B273;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-menu a:hover {
            color: #C88A32;
        }

        .cta-button {
            background: linear-gradient(135deg, #F3C164, #C88A32);
            color: #1C0E05;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 700;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(200, 138, 50, 0.3);
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(28, 14, 5, 0.4), rgba(28, 14, 5, 0.6)),
                url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 800"><rect fill="%237B4A23" width="1200" height="800"/><circle cx="300" cy="200" r="80" fill="%23C88A32" opacity="0.3"/><circle cx="900" cy="300" r="60" fill="%23F3C164" opacity="0.4"/><circle cx="600" cy="500" r="100" fill="%23E5B273" opacity="0.2"/></svg>');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
        }

        .hero-content {
            max-width: 800px;
            padding: 2rem;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 900;
            color: #F3C164;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2.5rem;
            color: #E5B273;
        }

        .hero-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: linear-gradient(135deg, #C88A32, #7B4A23);
            color: white;
            padding: 1rem 2rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #F3C164, #E5B273);
            color: #1C0E05;
            padding: 1rem 2rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        /* Sections */
        .section {
            padding: 5rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section h2 {
            font-size: 2.5rem;
            color: #C88A32;
            text-align: center;
            margin-bottom: 3rem;
            font-weight: 800;
        }

        /* Diferenciais */
        .diferenciais-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .diferencial-card {
            text-align: center;
            padding: 2rem;
            background: rgba(123, 74, 35, 0.1);
            border-radius: 20px;
            border: 1px solid rgba(200, 138, 50, 0.2);
            transition: transform 0.3s ease;
        }

        .diferencial-card:hover {
            transform: translateY(-5px);
            background: rgba(123, 74, 35, 0.2);
        }

        .diferencial-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, #C88A32, #F3C164);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .diferencial-card h3 {
            color: #F3C164;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        /* Produtos */
        .produtos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .produto-card {
            background: rgba(123, 74, 35, 0.1);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(200, 138, 50, 0.2);
            transition: transform 0.3s ease;
        }

        .produto-card:hover {
            transform: translateY(-5px);
        }

        .produto-image {
            height: 200px;
            background: linear-gradient(45deg, #7B4A23, #C88A32);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: #F3C164;
        }

        .produto-content {
            padding: 1.5rem;
        }

        .produto-card h3 {
            color: #F3C164;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .produto-card p {
            margin-bottom: 1.5rem;
            color: #E5B273;
        }

        /* Franquia */
        .franquia-section {
            background: linear-gradient(135deg, rgba(200, 138, 50, 0.1), rgba(243, 193, 100, 0.1));
            border-radius: 30px;
            padding: 4rem 2rem;
            text-align: center;
            margin: 3rem 0;
            border: 2px solid rgba(200, 138, 50, 0.3);
        }

        .franquia-section h2 {
            font-size: 3rem;
            color: #F3C164;
            margin-bottom: 1.5rem;
        }

        .franquia-section p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Depoimentos */
        .depoimentos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .depoimento-card {
            background: rgba(123, 74, 35, 0.1);
            padding: 2rem;
            border-radius: 20px;
            border-left: 4px solid #C88A32;
        }

        .depoimento-card p {
            font-style: italic;
            margin-bottom: 1rem;
            color: #E5B273;
        }

        .depoimento-autor {
            color: #F3C164;
            font-weight: 700;
        }

        /* Mapa */
        .mapa-container {
            background: rgba(123, 74, 35, 0.1);
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            border: 1px solid rgba(200, 138, 50, 0.2);
        }

        .mapa-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 ratio */
            height: 0;
            overflow: hidden;
            border-radius: 15px;
        }

        .mapa-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* Footer */
        .footer {
            background: rgba(28, 14, 5, 0.9);
            padding: 3rem 2rem 1rem;
            border-top: 1px solid rgba(200, 138, 50, 0.2);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .footer-section h3 {
            color: #C88A32;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .footer-section a {
            color: #E5B273;
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: #F3C164;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(200, 138, 50, 0.2);
            color: #7B4A23;
        }

        /* Mobile Menu */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #C88A32;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .section {
                padding: 3rem 1rem;
            }

            .franquia-section h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav-container">
            <a href="#" class="logo">🍪 Club do Cookie</a>
            <ul class="nav-menu">
                <li><a href="#home">Home</a></li>
                <li><a href="#cardapio">Cardápio</a></li>
                <li><a href="#unidades">Nossas Unidades</a></li>
                <li><a href="#marca">A Marca</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#contato">Contato</a></li>
                <li><a href="#franquia" class="cta-button" style="color: #201006;">SEJA UM FRANQUEADO</a></li>
            </ul>
            <button class="mobile-menu-toggle">☰</button>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Uma explosão de sabores</h1>
            <p>Descubra cookies artesanais feitos com ingredientes premium e receitas exclusivas que vão despertar todos
                os seus sentidos.</p>
            <div class="hero-buttons">
                <a href="#cardapio" class="btn-primary">Ver Cardápio</a>
                <a href="#franquia" class="btn-secondary">Seja um Franqueado</a>
            </div>
        </div>
    </section>

    <!-- Produtos -->
    <section class="section" id="cardapio">
        <h2>Produtos em Destaque</h2>
        <div class="produtos-grid">
            <div class="produto-card">
                <div class="produto-image">🍪</div>
                <div class="produto-content">
                    <h3>Cookie Chocolate Belga</h3>
                    <p>Massa amanteigada com pedaços generosos de chocolate belga premium</p>
                    <a href="#" class="btn-primary">Peça Agora</a>
                </div>
            </div>
            <div class="produto-card">
                <div class="produto-image">🥜</div>
                <div class="produto-content">
                    <h3>Cookie Nuts & Caramelo</h3>
                    <p>Combinação perfeita de nozes crocantes com caramelo artesanal</p>
                    <a href="#" class="btn-primary">Peça Agora</a>
                </div>
            </div>
            <div class="produto-card">
                <div class="produto-image">🍓</div>
                <div class="produto-content">
                    <h3>Cookie Red Velvet</h3>
                    <p>Sabor aveludado com cream cheese e toque de baunilha</p>
                    <a href="#" class="btn-primary">Peça Agora</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Mapa Localizador -->
    <section class="section" id="unidades">
        <h2>Encontre uma unidade próxima</h2>
        <div class="mapa-container">
            <div class="mapa-wrapper">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.755285270522!2d-37.288723925002365!3d-7.038020992963968!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7af6010af4e650d%3A0x1e2701f16f9aedd5!2sR.%20Severino%20Soares%2C%20303%20-%20Maternidade%2C%20Patos%20-%20PB%2C%2058701-380!5e0!3m2!1spt-BR!2sbr!4v1761489425901!5m2!1spt-BR!2sbr"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contato">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Navegação</h3>
                <a href="#home">Home</a>
                <a href="#cardapio">Cardápio</a>
                <a href="#unidades">Nossas Unidades</a>
                <a href="#marca">A Marca</a>
            </div>
            <div class="footer-section">
                <h3>Contato</h3>
                <a href="tel:+5583996420098">📞 (83) 9 9642-0098</a>
                <a href="mailto:contato@clubdocookie.com.br">✉️ contato@clubdocookie.com.br</a>
                <a href="#">📍 Rua Severino Soares, 303 Jd Guanabara Patos - PB</a>
            </div>
            <div class="footer-section">
                <h3>Redes Sociais</h3>
                <a href="#" target="_blank">Instagram</a>
                <a href="#" target="_blank">Facebook</a>
                <a href="#" target="_blank">TikTok</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025 Club do Cookie. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>

</html>
