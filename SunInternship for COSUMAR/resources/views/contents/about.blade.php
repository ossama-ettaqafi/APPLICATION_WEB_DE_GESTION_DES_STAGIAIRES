<section class="welcome">
    <div class="container">
    <h1>À propos de nous</h1>
    <p>
        Faites la connaissance d'OSSAMA, notre talentueux étudiant en génie
        informatique et fondateur de notre site de gestion de stages. Avec
        son expertise en développement web et en design UI/UX, il s'engage à
        fournir des services de haute qualité à nos clients.
    </p>
    </div>
</section>

<section class="advantages">
    <div class="container">
    <h2 class="advantages-title">Nos valeurs fondamentales</h2>
    <div class="advantages-container">
        <div class="advantage-card">
        <div class="advantage-icon"><i class="fas fa-thumbs-up"></i></div>
        <h3 class="advantage-title">Qualité</h3>
        <p class="advantage-description">
            Nous visons l'excellence dans tout ce que nous faisons et nous
            nous engageons à fournir des services de la plus haute qualité à
            nos clients.
        </p>
        </div>
        <div class="advantage-card">
        <div class="advantage-icon"><i class="fas fa-users"></i></div>
        <h3 class="advantage-title">Collaboration</h3>
        <p class="advantage-description">
            Nous croyons en une étroite collaboration avec nos clients et en
            la création de partenariats solides pour atteindre des objectifs
            communs et obtenir le succès.
        </p>
        </div>
        <div class="advantage-card">
        <div class="advantage-icon"><i class="fas fa-cog"></i></div>
        <h3 class="advantage-title">Innovation</h3>
        <p class="advantage-description">
            Nous recherchons constamment de nouvelles façons innovantes de
            résoudre les problèmes et d'améliorer nos services pour rester à
            la pointe.
        </p>
        </div>
    </div>
    </div>
</section>

<section class="team">
    <div class="container">
    <h2>Rencontrez notre équipe</h2>
    <div class="card-container">
        <div class="card">
        <img src="{{ asset('images/developer.png') }}" alt="Membre de l'équipe" />
        <div class="card-info">
            <h3 style="font-size: 1.5rem">OSSAMA ETTAQAFI</h3>
            <p style="font-size: 1rem">Étudiant en génie informatique</p>
            <p style="font-size: 1rem">Développement web | Design UI/UX</p>
            <div class="social-icons">
            <a
                href="https://www.linkedin.com/in/afatratinmypocket/"
                target="_blank"
                ><i class="fab fa-linkedin-in"></i
            ></a>
            <a href="https://github.com/afatratinmypocket" target="_blank"
                ><i class="fab fa-github"></i
            ></a>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>

<section class="developer">
    <div class="container">
    <h2>À propos du fondateur</h2>
    <div class="row">
        <div class="col">
        <img src="{{ asset('images/developer.png') }}" alt="Image du développeur" />
        <h3>OSSAMA ETTAQAFI</h3>
        <p>Étudiant en génie logiciel</p>
        <div class="social-icons">
            <a
            href="https://www.linkedin.com/in/afatratinmypocket/"
            target="_blank"
            ><i class="fab fa-linkedin-in"></i
            ></a>
            <a href="https://github.com/afatratinmypocket" target="_blank"
            ><i class="fab fa-github"></i
            ></a>
        </div>
        </div>

        <div class="col">
        <p>
            OSSAMA ETTAQAFI est un talentueux étudiant en génie informatique
            passionné par la simplification de la gestion des stages. Avec
            son service SunIntership, il vise à rendre le processus de
            création de stages plus efficace pour les employeurs. Ses
            compétences en langages de programmation et en frameworks tels
            que HTML, CSS et JavaScript lui ont permis de créer une
            plateforme conviviale qui répond aux besoins des entreprises.
        </p>
        </div>
    </div>
    </div>
</section>

<section id="contact" class="contact">
    <div class="container">
        <h2>Contactez-nous</h2>
        <p>Utilisez le formulaire ci-dessous pour nous contacter.</p>
        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name"><i class="fas fa-user"></i></label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Nom"
                    required
                />
            </div>
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i></label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Email"
                    required
                />
            </div>
            <div class="form-group">
                <label for="message"><i class="fas fa-comment-alt"></i></label>
                <textarea
                    id="message"
                    name="message"
                    placeholder="Message"
                    required
                ></textarea>
            </div>
            <div class="contact-note">
                <p>
                    <i class="fas fa-info-circle"></i> Pour toutes les demandes,
                    veuillez nous contacter à ossamaett2002@gmail.com
                </p>
            </div>
            <button type="submit">Envoyer</button>
        </form>
    </div>
</section>
