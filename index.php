<?php require_once 'head.php'; ?>
<?php require_once 'nav_bar.php'; ?>

<section id="accueil" class="hero-section">
    <div class="tech-decoration top-left"></div>
    <div class="hero-content">
        <h1>Dark Vador</h1>
        <h2 class="tech-title">Architecte des Défenses Impériales</h2>
        <p class="tagline">"La sécurité n'est pas une option. C'est une question de survie."</p>
        <div class="hero-cta">
            <button class="btn imperial-btn">
                <span class="tech-text">Audit de Sécurité</span>
            </button>
            <div class="security-status">
                <span class="status-text">Niveau de menace</span>
                <span class="status-indicator">CRITIQUE</span>
            </div>
        </div>
    </div>
    <div class="tech-decoration bottom-right"></div>
</section>

<section id="a-propos" class="about-section">
    <div class="container">
        <h2 class="section-title">Identité Système</h2>
        
        <div class="about-grid">
            <div class="about-image">
                <img src="sources/vader-portrait.jpg" alt="Dark Vador">
                <div class="system-scan"></div>
            </div>
            
            <div class="about-content">
                <div class="about-card">
                    <div class="card-header">
                        <i class="ri-shield-user-line"></i>
                        <h3>Identification</h3>
                    </div>
                    <p class="about-text">Expert en cybersécurité, Architecte des défenses impériales et Maître de l'OS Obscur. Ancien Jedi reconverti dans la sécurité offensive après une mise à jour majeure du système.</p>
                </div>

                <div class="about-stats">
                    <div class="stat-item">
                        <i class="ri-bug-line"></i>
                        <span class="stat-number">10K+</span>
                        <span class="stat-label">Failles corrigées</span>
                    </div>
                    <div class="stat-item">
                        <i class="ri-shield-check-line"></i>
                        <span class="stat-number">99.9%</span>
                        <span class="stat-label">Uptime système</span>
                    </div>
                    <div class="stat-item">
                        <i class="ri-code-box-line"></i>
                        <span class="stat-number">1M+</span>
                        <span class="stat-label">Lignes de code</span>
                    </div>
                </div>

                <div class="terminal-window">
                    <div class="terminal-header">
                        <span class="terminal-title">terminal@deathstar</span>
                        <div class="terminal-buttons">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <div class="terminal-content">
                        <p><span class="prompt">$</span> whoami</p>
                        <p class="response">DarkVador@EmpireGalactic</p>
                        <p><span class="prompt">$</span> cat skills.txt</p>
                        <p class="response">Pentesting avancé</p>
                        <p class="response">Exploitation des failles</p>
                        <p class="response">Architecture sécurisée</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="competences" class="skills-section">
    <div class="container">
        <h2 class="section-title">Arsenal Cybernétique</h2>
        
        <div class="skills-grid">
            <div class="skill-card offensive">
                <div class="card-header">
                    <i class="ri-shield-cross-line"></i>
                    <h3>Offensive</h3>
                </div>
                <ul>
                    <li>Pentesting avancé</li>
                    <li>Exploitation des failles</li>
                    <li>Red Teaming impérial</li>
                </ul>
                <div class="skill-meter">
                    <div class="meter-fill" style="width: 98%"></div>
                </div>
            </div>

            <div class="skill-card defensive">
                <div class="card-header">
                    <i class="ri-database-2-line"></i>
                    <h3>Défensive</h3>
                </div>
                <ul>
                    <li>Architecture sécurisée</li>
                    <li>Analyse des menaces</li>
                    <li>Gestion des incidents</li>
                </ul>
                <div class="skill-meter">
                    <div class="meter-fill" style="width: 95%"></div>
                </div>
            </div>

            <div class="skill-card cybernetic">
                <div class="card-header">
                    <i class="ri-cpu-line"></i>
                    <h3>Cybernétique</h3>
                </div>
                <ul>
                    <li>DarkOS™ Expert</li>
                    <li>Solutions intégrées</li>
                    <li>Protocoles propriétaires</li>
                </ul>
                <div class="skill-meter">
                    <div class="meter-fill" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="projets" class="projects-section">
    <div class="container">
        <h2 class="section-title">Projets Classifiés</h2>
        
        <div class="projects-grid">
            <div class="project-card">
                <div class="project-header">
                    <i class="ri-server-line"></i>
                    <span class="security-level">NIVEAU 5</span>
                </div>
                <h3>SithFirewall™</h3>
                <p>Système de pare-feu basé sur l'IA et la Force</p>
                <ul class="project-features">
                    <li>Protection contre les attaques Jedi</li>
                    <li>Détection d'intrusion avancée</li>
                    <li>99.9% de taux de blocage</li>
                </ul>
                <div class="project-footer">
                    <span class="project-status">ACTIF</span>
                    <button class="btn imperial-btn">Accès restreint</button>
                </div>
            </div>

            <div class="project-card">
                <div class="project-header">
                    <i class="ri-database-2-line"></i>
                    <span class="security-level">NIVEAU 4</span>
                </div>
                <h3>DarkForce™ Encryption</h3>
                <p>Protocole de cryptographie quantique</p>
                <ul class="project-features">
                    <li>Chiffrement post-quantique</li>
                    <li>Authentification biométrique</li>
                    <li>Résistant aux attaques de Force</li>
                </ul>
                <div class="project-footer">
                    <span class="project-status">EN PRODUCTION</span>
                    <button class="btn imperial-btn">Documentation</button>
                </div>
            </div>

            <div class="project-card">
                <div class="project-header">
                    <i class="ri-radar-line"></i>
                    <span class="security-level">NIVEAU 3</span>
                </div>
                <h3>RebelScan</h3>
                <p>Système de détection des rebelles</p>
                <ul class="project-features">
                    <li>Analyse comportementale</li>
                    <li>Détection d'anomalies</li>
                    <li>Réponse automatisée</li>
                </ul>
                <div class="project-footer">
                    <span class="project-status">DÉPLOYÉ</span>
                    <button class="btn imperial-btn">Rapports</button>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'footer.php'; ?>