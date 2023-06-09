<?php
template('header', array(
    'title' => 'Boite à outils • Accueil',
));

$messages = [];
// Send contact form to database
if (!empty($_POST)) {
    $submited_items = array(
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'subject' => $_POST['subject'],
        'message' => $_POST['message'],
        'accepte' => $_POST['accepte']
    );

    $validated_items = validate($submited_items, array(
        'name' => array(
            'label' => 'Name',
            'required' => true,
            'sanitize' => 'string',
            'min' => 2,
            'regexp' => '/^[\p{L} ]+$/u'
        ),
        'email' => array(
            'label' => 'Email',
            'required' => true,
            'sanitize' => 'email',
        ),
        'subject' => array(
            'label' => 'Subject',
            'required' => true,
            'sanitize' => 'string',
        ),
        'message' => array(
            'label' => 'Message',
            'required' => true,
            'sanitize' => 'string',
        ),
        'accepte' => array(
            'label' => 'Validation',
            'required' => true,
        )
    ));

    $result = check_validation($validated_items);

    if (!is_passed($result)) {
        $messages = $result;
    } else {
        $result = array(
            'name' => $result['name'],
            'email' => $result['email'],
            'subject' => $result['subject'],
            'message' => $result['message'],
        );
        
        if(insert('admin_messages', $result)) {
            $to = "allan.bouguerab@gmail.com";
            $subject = "MY TOOLBOX : Message reçu !";
            $nom = $result['name'];
            $message = "$nom vous a envoyé un message.";
            $headers = "Content-Type: text/plain; charset=utf-8\r\n";
            $headers .= "From: mytoolbox769@gmail.com\r\n";
            mail($to, $subject, $message, $headers);
            $messages['success'][] = 'Message envoyé !';
        }
    }
}
?>

    <!-- ======= About Section ======= -->
    <section id="homepage" class="homepage">
        <div class="container">
            <div class="section-title">
                <h2>La boite à outils </h2>
                <p>La boite à outils est un site accessible 24h/24 et 7j/7 qui vous permet de réaliser un bon nombre de calculs ou transformations nécessaires au quotidien</p>

                <p>Transformer 1/4 de litres en millilitres ou encore convertir des euros en dollars n'a jamais été aussi simple !</p>
            </div>

            <?php getAlert($messages); ?>

            <div class="row">
                <div class="col-lg-12 pt-4 pt-lg-0 content">
                    <h3>Il vous manque une fonctionnalité ?</h3>
                    <p class="fst-italic">
                        Écrivez-nous grâce au formulaire de contact et nous vous répondrons dans les plus brefs délais.
                    </p>
                    <form id="contact-form" name="contact-form" method="POST">
                        <!--Grid row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <label for="name" class="">Votre nom</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <label for="email" class="">Votre email (pour vous répondre)</label>
                                    <input type="text" id="email" name="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="md-form mb-0">
                                    <label for="subject" class="">Objet</label>
                                    <input type="text" id="subject" name="subject" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="md-form">
                                    <label for="message">Votre demande</label>
                                    <textarea id="message" name="message" rows="5" class="form-control md-textarea"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="ok" name="accepte" id="flexCheckDefault">
                                    <label class="form-check-label" for="accepte">
                                        J'accepte que mes données soient utilisées dans le cadre de demande de fonctionnalité
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-center mt-2 text-md-end">
                                    <button type="submit" class="btn  btn-block btn-primary">Envoyer</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section><!-- End Home Section -->


<?php template('footer');
