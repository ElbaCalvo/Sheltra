<?php

require_once __DIR__ . '/../model/Questionnaire.php';

class QuestionnaireController
{
    public function submitQuestionnaire($data)
    {
        $questionnaire = new Questionnaire(getDBConnection());

        $errors = $questionnaire->validateQuestionnaire($data);
        if (!empty($errors)) {
            return $errors;
        }

        $result = $questionnaire->create($data);
        return $result;
    }

    public function validateQuestionnaire($data) {
        $questionnaire = new Questionnaire(getDBConnection());
        return $questionnaire->validateQuestionnaire($data);
    }
}
