@php
    $faqs = [
        [
            'question' => 'Comment adopter un animal dans votre refuge ?',
            'answer' => 'L’adoption se fait en plusieurs étapes : une <strong>demande en ligne</strong>, un <strong>entretien</strong> avec notre équipe et, si tout est validé, une <strong>rencontre avec l’animal</strong>. L’objectif est de garantir une adoption responsable et durable.'
        ],
        [
            'question' => 'Quels sont les critères pour adopter un animal ?',
            'answer' => 'Nous évaluons votre <strong>mode de vie</strong>, votre <strong>disponibilité</strong>, votre <strong>logement</strong> et votre <strong>expérience</strong> avec les animaux afin de trouver la meilleure correspondance possible.'
        ],
        [
            'question' => 'Les animaux sont-ils vaccinés et stérilisés ?',
            'answer' => 'Oui. Tous nos animaux sont <strong>vaccinés</strong>, <strong>identifiés</strong> et <strong>stérilisés</strong> (ou avec engagement de stérilisation si l’âge ne le permet pas encore).'
        ],
        [
            'question' => 'Quels sont les frais d’adoption ?',
            'answer' => 'Les frais d’adoption couvrent une partie des <strong>soins vétérinaires</strong>, de l’<strong>alimentation</strong> et de l’<strong>hébergement</strong>. Le montant varie selon l’animal et est communiqué lors de la procédure.'
        ],
        [
            'question' => 'Puis-je devenir bénévole au refuge ?',
            'answer' => 'Oui, nous accueillons régulièrement des <strong>bénévoles</strong> pour l’entretien, les promenades, la socialisation des animaux ou l’aide administrative. Vous pouvez nous contacter via le <a href="/contact" class="underline">formulaire de contact</a>.'
        ],
        [
            'question' => 'Comment soutenir le refuge sans adopter ?',
            'answer' => 'Vous pouvez nous aider grâce à un <a href="/donate" class="underline">don financier</a>, des <strong>dons matériels</strong> ou en devenant <strong>famille d’accueil</strong> temporaire.'
        ],
    ];
@endphp


<div class="flex flex-col gap-6">
    @foreach ($faqs as $faq)
        <details class="mb-4 rounded-lg border border-red-strong bg--white">
            <summary class="p-6 flex justify-between items-center cursor-pointer select-none
            text-blue-strong text-2xl font-bold font-sans">
                {!! $faq['question'] !!}
                <x-icons.caret-down class="p-2 bg-red-strong rounded-full flex justify-center items-center"
                                    fill="fill-white"></x-icons.caret-down>
            </summary>
            <div class="px-6 pb-6 pt-2 text-blue-strong font-normal font-serif">
                {!! $faq['answer'] !!}
            </div>
        </details>
    @endforeach
</div>
