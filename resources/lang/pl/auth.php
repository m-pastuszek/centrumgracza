<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'   => 'Błędny login lub hasło.',
    'throttle' => 'Za dużo nieudanych prób logowania. Proszę spróbować za :seconds sekund.',

    // Activation items
    'sentEmail'        => 'Wysłaliśmy wiadomość do :email.',
    'clickInEmail'     => 'Kliknij w niego, aby aktywować konto.',
    'anEmailWasSent'   => 'Na podany adres e-mail została wysłana wiadomość z linkiem aktywacyjnym.',
    'clickHereResend'  => 'Kliknij tutaj, aby ponownie wysłać wiadomość e-mail.',
    'successActivated' => 'Twoje konto zostało pomyślnie aktywowane',
    'unsuccessful'     => 'Twoje konto nie mogło zostać aktywowane, spróbuj ponownie.',
    'notCreated'       => 'Nie można utworzyć konta, spróbuj ponownie.',
    'tooManyEmails'    => 'Wysłano zbyt wiele próśb aktywacyjnych na e-mail <b>:email</b>. <br /> <div class="alert alert-darken-danger">Spróbuj ponownie za <b>:hours godziny(y)</b>.</div>',
    'regThanks'        => 'Dziękujemy za rejestrację, ',
    'invalidToken'     => 'Nieprawidłowy token aktywacyjny. ',
    'activationSent'   => 'Wiadomość aktywacyjna została wysłana. ',
    'alreadyActivated' => 'To konto zostało już aktywowane. ',

    // Labels
    'whoops'          => 'Oh nie! ',
    'someProblems'    => 'Wystąpiło kilka problemów z wprowadzonymi przez Ciebie danymi.',
    'email'           => 'Adres e-mail',
    'password'        => 'Hasło',
    'rememberMe'      => ' Pamiętaj mnie',
    'login'           => 'Zaloguj',
    'forgot'          => 'Zapomniałeś hasło?',
    'forgot_message'  => 'Problemy z hasłem?',
    'name'            => 'Nazwa użytkownika',
    'first_name'      => 'Imię',
    'last_name'       => 'Nazwisko',
    'confirmPassword' => 'Potwierdź hasło',
    'register'        => 'Zarejestruj',

    // Placeholders
    'ph_name'          => 'Nazwa użytkownika',
    'ph_email'         => 'Adres e-mail',
    'ph_firstname'     => 'Imię',
    'ph_lastname'      => 'Nazwisko',
    'ph_password'      => 'Hasło',
    'ph_password_conf' => 'Potwierdź hasło',

    // User flash messages
    'sendResetLink' => 'Wyślij link resetowania hasła',
    'resetPassword' => 'Resetuj hasło',
    'loggedIn'      => 'Zalogowano!',

    // email links
    'pleaseActivate'    => 'Musisz aktywować swoje konto.',
    'clickHereReset'    => 'Kliknij tutaj, aby zresetować swoje hasło: ',
    'clickHereActivate' => 'Kliknij tutaj, aby aktywować swoje konto: ',

    // Validators
    'userNameTaken'    => 'Nazwa użytkownika jest już zajęta.',
    'userNameRequired' => 'Pole <b>Nazwa użytkownika</b> jest wymagane.',
    'fNameRequired'    => 'Pole <b>Imię</b> jest wymagane.',
    'lNameRequired'    => 'Pole <b>Nazwisko</b> jest wymagane.',
    'emailRequired'    => '<b>Adres e-mail</b> jest wymagany.',
    'emailInvalid'     => 'Wprowadzono błędny adres e-mail.',
    'passwordRequired' => 'Wprowadzenie hasła jest wymagane.',
    'PasswordMin'      => 'Hasło musi mieć co najmniej 6 znaków.',
    'PasswordMax'      => 'Maksymalna długość hasła wynosi 20 znaków.',
    'captchaRequire'   => 'Pole Captcha jest wymagane.',
    'CaptchaWrong'     => 'Udowodnij, że nie jesteś robotem.',
    'roleRequired'     => 'Rola użytkownika jest wymagana.',
];
