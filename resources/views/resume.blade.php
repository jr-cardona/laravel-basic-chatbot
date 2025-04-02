<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Resúmenes</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 20px; }
        textarea { width: 80%; height: 150px; }
        button { padding: 10px 20px; margin-top: 10px; }
        #resultado { margin-top: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Generador de Resúmenes con IA</h1>
    <form id="resumenForm">
        @csrf
        <textarea id="texto" name="texto" placeholder="Escribe aquí el texto..."></textarea><br>
        <button type="submit">Generar Resumen</button>
    </form>
    <p id="error" style="color: red;"></p>
    <h2>Resumen:</h2>
    <p id="resultado"></p>

    <script>
        document.getElementById('resumenForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            
            const text = document.getElementById('texto').value;
            const errorElem = document.getElementById('error');
            const resultadoElem = document.getElementById('resultado');
            
            errorElem.innerText = ''; 
            resultadoElem.innerText = 'Generando resumen...';

            const response = await fetch("{{ route('summary.generate') }}", {
                method: "POST",
                headers: { 
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ text })
            });

            const data = await response.json();

            if (response.ok) {
                resultadoElem.innerText = data.summary;
            } else {
                errorElem.innerText = data.error || "Error al generar el resumen.";
                resultadoElem.innerText = '';
            }
        });
    </script>
</body>
</html>
