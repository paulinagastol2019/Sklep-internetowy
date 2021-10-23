<!--kontakt i formularz kontaktowy-->
<main class="contact">
    <div class="bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12 mt-5">
                <i class="fas fa-map-marker-alt"></i>
                <h4>Adres biura wysyłki zamówień</h4>
                <p>ul.Internetowa 4, 30-875 Kraków</p>
            </div>
            <div class="col-lg-4 col-12 mt-5">
                <i class="fas fa-phone-alt"></i>
                <h4>Telefon</h4>
                <p>Dział zakupów: 789-789-987 <br>
                    Reklamacje: 867-487-485</p>
            </div>
            <div class="col-lg-4 col-12 mt-5">
                <i class="fas fa-envelope-open-text"></i>
                <h4>Adres e-mail</h4>
                <p>biuro@pasazhigieniczny.pl</p>
            </div>
        </div>
    </div>

    <div class="containerform">
        <h4 class="formtitle">Formularz kontaktowy</h4>
        <form method="post" name="contactform" action="mail.php">
                <input type="text"  class="in1" name="name1" placeholder=" Imię" required/>
                <input type="text" class="in1" name="emailFrom" placeholder=" Adres e-mail" required/>
                <textarea name="message1" class="in2" placeholder=" Napisz wiadomość..." required></textarea>
                <button type="submit"  name="submit" class="btnform">Wyślij</button>
        </form>
    </div>
</main>
