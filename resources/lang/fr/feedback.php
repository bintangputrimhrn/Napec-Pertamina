<?php

return [
    'title' => 'Pertamina NAPEC 2026',
    'subtitle' => 'Renseignements concernant le visiteur',
    'language' => [
        'english' => 'English',
        'france' => 'France',
    ],
    'fields' => [
        'name' => 'Nom',
        'company_name' => "Nom de l'entreprise",
        'email' => 'Courriel',
        'job_title' => 'Désignation professionnelle',
    ],
    'questions' => [
        'heard_from' => 'Comment avez-vous entendu parler de notre stand d’exposition ?',
        'booth_rating' => 'Sur une échelle de 1 à 5, comment évalueriez-vous la présentation générale et l’attractivité de notre stand ?',
        'booth_design' => 'L’agencement et la conception du stand ont-ils permis de communiquer efficacement sur notre entreprise ?',
        'attention_aspect' => 'Quel aspect de notre stand a le plus retenu votre attention ?',
        'representative_rating' => 'Nos représentants étaient-ils compétents et serviables pour répondre à vos demandes ?',
        'learned_something' => 'Avez-vous appris quelque chose de nouveau sur notre entreprise/nos produits/nos services lors de votre visite ?',
        'improvements' => 'Quelles améliorations, le cas échéant, suggéreriez-vous pour notre stand lors des prochains salons ?',
        'interested_products' => 'Y avait-il des produits ou des services spécifiques qui vous ont particulièrement intéressé ? Si oui, veuillez préciser.',
        'presentation_feedback' => 'Avez-vous assisté à l’une de nos présentations ? Si oui, veuillez nous faire part de vos commentaires sur le contenu et la manière dont elles ont été présentées.',
        'overall_satisfaction' => 'Dans l’ensemble, dans quelle mesure avez-vous été satisfait de votre expérience sur notre stand ?',
        'recommendation' => 'Seriez-vous prêt à recommander notre entreprise/nos produits/nos services à d’autres personnes de votre secteur ?',
    ],
    'options' => [
        'heard_from' => [
            'online_advertisement' => 'Publicité en ligne',
            'social_media' => 'Réseaux sociaux',
            'word_of_mouth' => 'Bouche à oreille',
            'other' => 'Autre (veuillez préciser) :',
        ],
        'booth_design' => ['yes' => 'Oui', 'no' => 'Non', 'partially' => 'Partiellement'],
        'attention_aspect' => [
            'visuals_graphics' => 'Visuels/Graphiques',
            'product_displays' => 'Produits exposés',
            'demonstrations' => 'Présentations',
            'interactive_elements' => 'Éléments interactifs',
            'other' => 'Autre (veuillez préciser) :',
        ],
        'representative_rating' => [
            'very_knowledgeable' => 'Très compétents et serviables',
            'somewhat_knowledgeable' => 'Plutôt compétents et serviables',
            'not_knowledgeable' => 'Ni compétents ni serviables',
        ],
        'learned_something' => ['yes' => 'Oui', 'no' => 'Non'],
        'overall_satisfaction' => [
            'very_satisfied' => 'Très satisfait',
            'satisfied' => 'Satisfait',
            'neutral' => 'Neutre',
            'dissatisfied' => 'Insatisfait',
            'very_dissatisfied' => 'Très insatisfait',
        ],
        'recommendation' => [
            'yes' => 'Oui',
            'no' => 'Non',
            'additional' => 'Autres commentaires ou suggestions à nous faire ?',
        ],
    ],
    'rating' => ['poor' => 'Mauvais', 'excellent' => 'Excellent'],
    'actions' => ['submit' => 'Submit', 'back_home' => 'Retour à l’accueil'],
    'messages' => [
        'required' => 'Veuillez remplir ce champ.',
        'database_error' => 'Nous ne pouvons pas enregistrer vos commentaires pour le moment. Veuillez réessayer.',
        'thanks' => 'Merci pour vos commentaires.',
    ],
];
