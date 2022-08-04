<div class="cd-signin-modal js-signin-modal">
		<!-- this is the entire modal form, including the background -->

		<div class="cd-signin-modal__container">
			<!-- this is the container wrapper -->

			<ul class="cd-signin-modal__switcher js-signin-modal-switcher js-signin-modal-trigger">
				<li><a href="#0" data-signin="login" data-type="login">Connexion</a></li>
				<li><a href="#0" data-signin="signup" data-type="signup">Inscription</a></li>
			</ul>

			<!-- log in form -->
			<div class="cd-signin-modal__block js-signin-modal-block" data-type="login" id="signin" >

				<form class="cd-signin-modal__form" action="controller/login.php" method="post" id="signin">

					<p class="cd-signin-modal__fieldset">
						<label class="cd-signin-modal__label cd-signin-modal__label--email cd-signin-modal__label--image-replace" for="signin-login">Pseudo</label>
						<input class="cd-signin-modal__input cd-signin-modal__input--full-width cd-signin-modal__input--has-padding cd-signin-modal__input--has-border" id="signin-login" type="text" placeholder="Pseudo" name="signin-username">
						<span class="cd-signin-modal__error">Error message here!</span>
					</p>

					<p class="cd-signin-modal__fieldset">
						<label class="cd-signin-modal__label cd-signin-modal__label--password cd-signin-modal__label--image-replace" for="signin-password">Mot de passe</label>
						<input class="cd-signin-modal__input cd-signin-modal__input--full-width cd-signin-modal__input--has-padding cd-signin-modal__input--has-border" id="signin-password" type="password" placeholder="Mot de passe" name="signin-password">
						<a href="#0" class="cd-signin-modal__hide-password js-hide-password">Afficher</a>
						<span class="cd-signin-modal__error">Error message here!</span>
					</p>

					<p class="cd-signin-modal__fieldset">
						<input class="cd-signin-modal__input cd-signin-modal__input--full-width" type="submit" value="Connexion">
					</p>

				</form>

			</div> <!-- cd-signin-modal__block -->

			<!-- sign up form -->
			<div class="cd-signin-modal__block js-signin-modal-block" data-type="signup">

				<form class="cd-signin-modal__form" id="signup" action="controller/signup.php" method="POST">

					<p class="cd-signin-modal__fieldset">
						<label class="cd-signin-modal__label cd-signin-modal__label--username cd-signin-modal__label--image-replace" for="signup-username">Pseudo</label>
						<input class="cd-signin-modal__input cd-signin-modal__input--full-width cd-signin-modal__input--has-padding cd-signin-modal__input--has-border" id="signup-username" type="text" placeholder="Pseudo" name="signup-username">
						<span class="cd-signin-modal__error">Error message here!</span>
					</p>

					<!-- <p class="cd-signin-modal__fieldset">
						<label class="cd-signin-modal__label cd-signin-modal__label--email cd-signin-modal__label--image-replace" for="signup-email">E-mail</label>
						<input class="cd-signin-modal__input cd-signin-modal__input--full-width cd-signin-modal__input--has-padding cd-signin-modal__input--has-border" id="signup-email" type="email" placeholder="E-mail" name="signup-email">
						<span class="cd-signin-modal__error">Error message here!</span>
					</p> -->

					<p class="cd-signin-modal__fieldset">
						<label class="cd-signin-modal__label cd-signin-modal__label--password cd-signin-modal__label--image-replace" for="signup-password">Mot de passe</label>
						<input class="cd-signin-modal__input cd-signin-modal__input--full-width cd-signin-modal__input--has-padding cd-signin-modal__input--has-border" id="signup-password" type="password" placeholder="Mot de passe" name="signup-password">
						<a href="#0" class="cd-signin-modal__hide-password js-hide-password">Afficher</a>
						<span class="cd-signin-modal__error">Error message here!</span>
					</p>

					<p class="cd-signin-modal__fieldset">
						<label class="cd-signin-modal__label cd-signin-modal__label--password cd-signin-modal__label--image-replace" for="signup-password">Confirmation mot de passe</label>
						<input class="cd-signin-modal__input cd-signin-modal__input--full-width cd-signin-modal__input--has-padding cd-signin-modal__input--has-border" id="signup-password-confirmation" type="password" placeholder="Confirmation mot de passe" name="signup-password-confirmation">
						<a href="#0" class="cd-signin-modal__hide-password js-hide-password">Afficher</a>
						<span class="cd-signin-modal__error">Error message here!</span>
					</p>

					<p class="cd-signin-modal__fieldset">
						<input class="cd-signin-modal__input cd-signin-modal__input--full-width cd-signin-modal__input--has-padding" type="submit" value="Valider" form="signup">
					</p>

				</form>
			</div> <!-- cd-signin-modal__block -->

			<a href="#0" class="cd-signin-modal__close js-close">Quitter</a>

		</div> <!-- cd-signin-modal__container -->

	</div> <!-- cd-signin-modal -->
