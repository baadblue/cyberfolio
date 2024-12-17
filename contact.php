<?php require_once 'head.php'; ?>
<?php require_once 'nav_bar.php'; ?>

<section id="contact" class="contact-section">
    <div class="container">
        <h2 class="section-title">Canal de Communication</h2>
        
        <div class="contact-grid">
            <div class="contact-info">
                <div class="terminal-window">
                    <div class="terminal-header">
                        <span class="terminal-title">contact_info.sh</span>
                    </div>
                    <div class="terminal-content">
                        <p><span class="prompt">$</span> cat contact.txt</p>
                        <ul class="contact-list">
                            <li>
                                <i class="ri-mail-line"></i>
                                <span>DarkVador@CyberSithEmpire.gal</span>
                            </li>
                            <li>
                                <i class="ri-git-repository-line"></i>
                                <span>git.sithcode.empire/darkvador</span>
                            </li>
                            <li>
                                <i class="ri-discord-line"></i>
                                <span>@LordOfEncryption#1977</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <form class="contact-form" action="formulaire.php" method="POST">
                <div class="form-header">
                    <i class="ri-lock-line"></i>
                    <span>Canal sécurisé - Chiffrement DarkForce™</span>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Identifiant système" name="id" required>
                </div>
                <div class="form-group">
                    <input type="email" placeholder="Adresse de communication" name="email" required>
                </div>
                <div class="form-group">
                    <select name="niveau" required>
                        <option value="">Niveau d'accréditation</option>
                        <option value="1">Niveau 1 - Standard</option>
                        <option value="2">Niveau 2 - Confidentiel</option>
                        <option value="3">Niveau 3 - Secret</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea placeholder="Message crypté" name="message" required></textarea>
                </div>
                <button type="submit" name="envoi" class="btn imperial-btn">
                    <i class="ri-send-plane-line"></i>
                    Transmission sécurisée
                </button>
            </form>
        </div>
    </div>
</section>


<?php require_once 'footer.php'; ?>