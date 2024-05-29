<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body class="container">
    <br> <br>
    <div class="row">
        <div class="col-md-6">
            <form id="request" class="jumbotron">
                <h3>GERAR RELATÓRIO OFF-SITE</h3>
                <div class="form-group">
                    <label for="">Data inicial:</label>
                    <input class="form-control" id="_date_inicio" type="date" require>
                </div>

                <div class="form-group">
                    <label for="">Data final:</label>
                    <input class="form-control" id="_date_final" type="date" require>
                </div>
                <button class="btn btn-success" type="submit">Download Excel</button>
            </form>
        </div>
        <div class="col-md-6"></div>
    </div>
    <div id="message" class=""></div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js" integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        const button = document.getElementById("request")
        let errorHtml = document.getElementById("message");



        button.addEventListener("submit", (ev) => {

            ev.preventDefault();
            const _date_inicio = document.getElementById("_date_inicio").value;
            const _date_final = document.getElementById("_date_final").value;


            if (!_date_inicio || !_date_final) {
                errorHtml.innerHTML = `<div class='text text-danger'>Preencha os campos.</div>`;
                return;
            }


            errorHtml.innerHTML = "";
            axios.get(`{{ config('app.url_api') }}/api/report?data_inicial=${_date_inicio}&data_final=${_date_final}`)
                .then(response => {
                    errorHtml.innerHTML = '<div class="alert alert-success"> relatório off-site foi gerado com sucesso. </div>';
                    document.location.href = response.data.url
                }).catch(error => {
                  
                    errorHtml.innerHTML = `<div class='text text-danger alert alert-danger'>${JSON.stringify(error.response.data)}</div>`;
                })

        })
    </script>
</body>

</html>