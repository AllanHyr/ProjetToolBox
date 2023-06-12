<?php
template('header', array(
    'title' => 'Boite à outils • Convertisseur',
));
?>

    <!-- ======= About Section ======= -->
    <section id="homepage" class="homepage">
        <div class="container">
            <div class="section-title">
                <h2>Convertisseur</h2>
            </div>

            <div class="row">

                <fieldset class="col-12 mt-4">
                    <legend>Convertisseur de devise</legend>
                    <form action="" method="post" name="devise">
                        <div class="form-group row mb-3">
                            <div class="col-md-4">
                                <label for="EUR" aria-hidden="true" hidden>Euros</label>
                                <div class="input-group">
                                    <input id="deviseValue" name="deviseValue" type="number" class="form-control" required>
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

                            <div class="text-center col-md-2 mb-1 mt-1">
                                <span class="ver">vaut actuellement</span>
                            </div>

                            <div class="col-md-4">
                                <label for="USD" aria-hidden="true" hidden>Dollars</label>
                                <div class="input-group">
                                    <input id="resultDevise" name="resultDevise" type="number" class="form-control" disabled>
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
                            <div class="col-md-2 mt-2 mt-md-0 m-auto col-4">
                                <button name="submit" type="submit" class="btn btn-primary btn-block">Calculer</button>
                            </div>

                            <!--https://fr.calcuworld.com/calculs-mathematiques/calculatrice-pourcentage/-->
                        </div>
                    </form>
                </fieldset>
                </div>
                <div class="row">

                    <fieldset class="col-12 mt-4">
                        <legend>Convertisseur de volume</legend>
                        <form action="" method="post" name="volume">
                            <div class="form-group row mb-3">
                                <div class="col-md-4">
                                    <label for="EUR" aria-hidden="true" hidden>Euros</label>
                                    <div class="input-group">
                                        <input id="volumeValue" name="volumeValue" type="number" class="form-control" required>
                                        <select class="form-select" id="inputVolume" name="inputVolume">
                                            <option value="0.001" selected>Millilitre</option>
                                            <option value="0.01">Centilitre</option>
                                            <option value="0.1">Décilitre</option>
                                            <option value="1">Litre</option>
                                            <option value="10">Décalitre</option>
                                            <option value="100">Hectolitre</option>
                                        </select>
                                        </select>
                                    </div>
                                </div>

                                <div class="text-center col-md-2 mb-1 mt-1">
                                    <span class="ver">vaut actuellement</span>
                                </div>

                                <div class="col-md-4">
                                    <label for="USD" aria-hidden="true" hidden>Dollars</label>
                                    <div class="input-group">
                                        <input id="resultVolume" name="resultVolume" type="number" class="form-control" disabled>
                                        <select class="form-select" id="outputVolume" name="outputVolume">
                                            <option value="0.001">Millilitre</option>
                                            <option value="0.01" selected>Centilitre</option>
                                            <option value="0.1">Décilitre</option>
                                            <option value="1">Litre</option>
                                            <option value="10">Décalitre</option>
                                            <option value="100">Hectolitre</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2 mt-md-0 m-auto col-4">
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
