<!DOCTYPE html>

<html lang="it">

<head>
    <!-- Autore: Leonardo Magliolo
     Descrizione: La pagina svolge funzioni di registrazione e login alla piattaforma
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Login/SignUp</title>
    <link rel="stylesheet" type="text/css"  href="../../CSS/LoginSignup/LoginSignupForm.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <script src="../../JS/LoginSignup/LoginSignupForm.js"></script>
</head>

<body>
<div class="container" id="container" >
    <div class="form-container sign-up-container" >
        <form id = "formRegistrazione">
            <div id="datiClienti">
                <h1>Crea il tuo account</h1>
                <input type="text" id="Nome" name="Nome" placeholder="Nome" required/>
                <input type="text" id="Cognome" name="Cognome" placeholder="Cognome" required/>
                <input type="text" id="Codice_fiscale" name="Codice_fiscale" placeholder="Codice fiscale" required/>
                <p>Data di nascita: <input type="date" name="Data_nascita" required/></p>
                <input type="text" id="Città_residenza" name="Città_residenza" placeholder="Città di residenza" required/>
                <input type="text" id="Indirizzo_residenza" name="Indirizzo_residenza" placeholder="Indirizzo di residenza" required/>
                <input type="text" id= "Città_nascita" name="Città_nascita" placeholder="Città di nascita" required/>
                <input type="email" name="Email" placeholder="Email" required/>
                <input type="password" id ="PasswordSignIn" name="Password" placeholder="Password" required/>
                 La password deve soddifare i seguenti criteri:
                <ul>
                    <li>Almeno una lettera maiuscola</li>
                    <li>Almeno una lettera minuscola</li>
                    <li>Almeno un numero</li>
                    <li>Almeno un carattere speciale</li>
                    <li>Una lunghezza minima di 8 caratteri</li>
                    <li>Una lunghezza massima di 30 caratteri</li>
                </ul>
            </div>

            Sono un:
            <p id="roleSelector">
                <input type="radio" name="role" value="Cliente" checked="checked" id="radioCliente">
                <label for="radioCliente">Cliente</label>
                <input type="radio" name="role" value="Medico" id="radioMedico">
                <label for="radioMedico">Medico</label>
                <input type="radio" name="role" value="Farmacista" id="radioFarmacista">
                <label for="radioFarmacista">Farmacista</label>
            </p>

            <p id="datiFarmacisti">
                <input type="text" class="datiFarmacisti" id="Nome_farmacia" name="Nome_farmacia" placeholder="Nome della farmacia"/>
                <input type="text" class="datiFarmacisti" id="Città_farmacia" name="Città_farmacia" placeholder="Città in cui la farmacia si trova"/>
                <input type="text" class="datiFarmacisti" id="Indirizzo_farmacia" name="Indirizzo_farmacia" placeholder="Indirizzo della farmacia"/>
            </p>
            <h6>(Tutti i dati richiesti sono obbligatori per procedere alla registrazione)</h6>
            <button id="signUpForm" type="submit" name="signUp" value="signUp">Registrati</button>
            <p id="signUpErrorMessage"></p>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form id = "formLogin">
            <h1>Accedi</h1>
            <input type="Email" name="Email" placeholder="Email" required/>
            <input type="Password" name="Password" placeholder="Password" required/>
            <button type="submit" name="Login" value="login">Accedi</button>
            <p id="loginErrorMessage"></p>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Bentornato!</h1>
                <p>Per rimanere connesso accedi con i tuoi dati personali</p>
                <button class="ghost" id="signIn">Accedi</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Ciao!</h1>
                <p>Inserisci i tuoi dati personali e usufruisci dei nostri servizi</p>
                <button class="ghost" id="signUp">Registrati</button>
            </div>
        </div>
    </div>
</div>

</body>

</html>


