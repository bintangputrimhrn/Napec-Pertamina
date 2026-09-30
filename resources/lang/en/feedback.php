<?php

return [
    'title' => 'Pertamina NAPEC 2026',
    'subtitle' => 'Visitor Information',
    'language' => [
        'english' => 'English',
        'france' => 'France',
    ],
    'fields' => [
        'name' => 'Name',
        'company_name' => 'Company Name',
        'email' => 'Email Address',
        'job_title' => 'Job Title',
    ],
    'questions' => [
        'heard_from' => 'How did you hear about our exhibition booth?',
        'booth_rating' => 'On a scale of 1 to 5, how would you rate the overall presentation and attractiveness of our booth?',
        'booth_design' => 'Did the booth layout and design effectively communicate our company?',
        'attention_aspect' => 'Which aspect of our booth caught your attention the most?',
        'representative_rating' => 'Were our representatives knowledgeable and helpful in addressing your inquiries?',
        'learned_something' => 'Did you learn something new about our company/products/services during your visit?',
        'improvements' => 'What improvements, if any, would you suggest for our booth in future exhibitions?',
        'interested_products' => 'Were there any specific products or services that particularly interested you? If so, please specify.',
        'presentation_feedback' => 'Did you attend any of our presentations or demonstrations? If yes, please provide feedback on the content and delivery.',
        'overall_satisfaction' => 'Overall, how satisfied were you with your experience at our booth?',
        'recommendation' => 'Would you be willing to recommend our company/products/services to others in your industry?',
    ],
    'options' => [
        'heard_from' => [
            'online_advertisement' => 'Online advertisement',
            'social_media' => 'Social media',
            'word_of_mouth' => 'Word of mouth',
            'other' => 'Other (please specify):',
        ],
        'booth_design' => ['yes' => 'Yes', 'no' => 'No', 'partially' => 'Partially'],
        'attention_aspect' => [
            'visuals_graphics' => 'Visuals/Graphics',
            'product_displays' => 'Product displays',
            'demonstrations' => 'Demonstrations',
            'interactive_elements' => 'Interactive elements',
            'other' => 'Other (please specify):',
        ],
        'representative_rating' => [
            'very_knowledgeable' => 'Very knowledgeable and helpful',
            'somewhat_knowledgeable' => 'Somewhat knowledgeable and helpful',
            'not_knowledgeable' => 'Not knowledgeable or helpful',
        ],
        'learned_something' => ['yes' => 'Yes', 'no' => 'No'],
        'overall_satisfaction' => [
            'very_satisfied' => 'Very satisfied',
            'satisfied' => 'Satisfied',
            'neutral' => 'Neutral',
            'dissatisfied' => 'Dissatisfied',
            'very_dissatisfied' => 'Very Dissatisfied',
        ],
        'recommendation' => [
            'yes' => 'Yes',
            'no' => 'No',
            'additional' => 'Any additional comments or suggestions for us?',
        ],
    ],
    'rating' => ['poor' => 'Poor', 'excellent' => 'Excellent'],
    'actions' => ['submit' => 'Submit', 'back_home' => 'Back to Home'],
    'messages' => [
        'required' => 'Please complete this field.',
        'database_error' => 'We could not save your feedback right now. Please try again.',
        'thanks' => 'Thank you for your feedback.',
    ],
];
