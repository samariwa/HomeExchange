<?php
class Faq{
    public function GetAllFaqs()
    {
        $db = new Database();
        return $db->getAll('faqs');
    }

    public function AddFaq($question, $answer)
    {
        $db = new Database();
        return $db->insert("faqs", array('question' => $question, 'answer' => $answer));
    }

    public function GetFaq($field, $where = array())
    {
        $db = new Database();
        return $db->get('faqs', $field, $where);
    }
}