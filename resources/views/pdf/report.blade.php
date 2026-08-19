<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Rapport Mensuel</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        td { padding: 6px 0; border-bottom: 1px solid #ddd; }
        td.value { text-align: right; }
    </style>
</head>

<body>
    <h1>Les Pattes Heureuses</h1>
    <p>Voici le résumé de l'activité du refuge pour la période : {{ $month }}.</p>

    <table>
        @foreach ($stats as $label => $value)
            <tr>
                <td>{{ $label }}</td>
                <td class="value">{{ $value }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
