<?php
template('header', array(
    'title' => 'Boite à outils • Devise',
));
?>

    <!-- ======= About Section ======= -->
    <section id="homepage" class="homepage">
        <div class="container">
            <div class="section-title">
                <h2>Convertisseur de devise</h2>
            </div>

            <div class="row">

                <fieldset class="col-12 mt-4">
                    <legend>Euro vers dollar américain</legend>
                    <form action="" method="post" name="euros-dollars">
                        <div class="form-group row mb-3">
                            <div class="col-4">
                                <label for="EUR" aria-hidden="true" hidden>Euros</label>
                                <div class="input-group">
                                    <input id="inputValue" name="inputValue" type="number" class="form-control" required>
                                    <select class="form-select" id="inputDevise" name="inputDevise">
                                        <option value="EUR" selected>EUR</option>
                                        <option value="USD">USD</option>
                                        <option value="SLL">SLL</option>
                                        <option value="BHD">BHD</option>
                                        <option value="CAD">CAD</option>
                                        <option value="KGS">KGS</option>
                                        <option value="VND">VND</option>
                                        <option value="GBP">GBP</option>
                                    </select>
                                </div>
                            </div>

                            <div class="text-center col-2">
                                <span class="ver">vaut actuellement</span>
                            </div>

                            <div class="col-4">
                                <label for="USD" aria-hidden="true" hidden>Dollars</label>
                                <div class="input-group">
                                    <input id="outputValue" name="outputValue" type="number" class="form-control" disabled>
                                    <select class="form-select" id="outputDevise" name="outputDevise">
                                        <option value="EUR">EUR</option>
                                        <option value="USD" selected>USD</option>
                                        <option value="SLL">SLL</option>
                                        <option value="BHD">BHD</option>
                                        <option value="CAD">CAD</option>
                                        <option value="KGS">KGS</option>
                                        <option value="VND">VND</option>
                                        <option value="GBP">GBP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <button name="submit" type="submit" class="btn btn-primary btn-block">Calculer</button>
                            </div>

                            <!--https://fr.calcuworld.com/calculs-mathematiques/calculatrice-pourcentage/-->
                        </div>
                    </form>
                </fieldset>
                </div>
            </div>
    </section><!-- End Home Section -->


    <script type="text/javascript">
        window.addEventListener('load', () => {
            let forms = document.forms;

            for(form of forms){
                form.addEventListener('submit', async (event) => {
                    event.preventDefault();

                    const formData = new FormData(event.target).entries()

                    const response = await fetch('/api/post', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(
                            Object.assign(Object.fromEntries(formData), {form: event.target.name})
                        )
                    });

                    const result = await response.json();

                    let inputName = Object.keys(result.data)[0];

                    event.target.querySelector(`input[name="${inputName}"]`).value = result.data[inputName];
                })
            }
        });
    </script>

<?php template('footer');
