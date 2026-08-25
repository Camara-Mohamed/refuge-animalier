<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Rapport Mensuel</title>
</head>

<body>
    <h1>Les Pattes Heureuses</h1>
    <p>Résumé de l'activité du refuge - {{ $month }}</p>

    <table border="1" cellpadding="6" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th align="left">Indicateur</th>
                <th align="right">Valeur</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stats as $label => $value)
                <tr>
                    <td>{{ $label }}</td>
                    <td align="right">{{ $value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
