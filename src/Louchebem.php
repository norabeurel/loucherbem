<?php
include "Request.php";
include "Word.php";

class Louchebem
{

  /**
   * @var Request
   */
  protected Request $request;

  /**
   * @var array
   */
  protected array $terminaisons;

  /**
   * @var array
   */
  protected array $words = array();

  /**
   * @var array
   */
  protected array $errors = array();

  /**
   * Construct Louchebem
   */
  public function __construct()
  {
    $this->request = new Request();
    $this->terminaisons = array(
      "em"     => "em",
      "me"     => "me",
      "uche"   => "uche",
      "ji"     => 'ji',
      "oque"   => "oque",
    );
  }

  /**
   * @return $this
   */
  public function execute(): louchebem
  {
    if($this->request->isPost())
    {
      if(!$this->request->getValueByFieldname('word'))
      {
        $this->addError("word", "Cette valeur est requise !!!");
      }
      if(!$this->request->getValueByFieldname('terminaison'))
      {
        $this->addError("terminaison", "Cette valeur est requise !!!");
      }

      if(count($this->errors) <= 0)
      {
        $wordsSends = $this->request->getValueByFieldname("word");
        preg_match_all("/[\p{L}'']+/u", $wordsSends, $words);
        foreach ($words[0] as $word)
        {
          $this->addWord($word);
        }
      }
    }
    return $this;
  }

  /**
   * @return Request
   */
  public function getRequest(): Request
  {
    return $this->request;
  }

  /**
   * @return array
   */
  public function getTerminaisons(): array
  {
    return $this->terminaisons;
  }

  /**
   * @param array $terminaisons
   *
   * @return $this
   */
  public function setTerminaisons(array $terminaisons): louchebem
  {
    $this->terminaisons = $terminaisons;
    return $this;
  }

  /**
   * @param string $word
   *
   * @return $this
   */
  public function addWord(string $word): louchebem
  {
    $this->words[] = new Word($word, $this->request->getValueByFieldname("terminaison"));
    return $this;
  }

  /**
   * @return string
   */
  public function viewTransformWords(): string
  {
    $wordsSearch = array();
    $wordsReplace = array();
    /** @var Word $word */
    foreach($this->getWords() as $word)
    {
      $wordsSearch[] = "/(?<![A-Za-z'])" . preg_quote($word->getWord(), '/') . "(?![A-Za-z'])/";
      $wordsReplace[] = $word->getWordTransform();
    }
    if($this->request->getValueByFieldname("word") && count($this->errors) <= 0)
    {
      return preg_replace($wordsSearch, $wordsReplace, $this->request->getValueByFieldname("word"));
    }
    return "";
  }

  /**
   * @return array
   */
  public function getWords(): array
  {
    return $this->words;
  }

  /**
   * @param array $words
   *
   * @return $this
   */
  public function setWords(array $words): louchebem
  {
    $this->words = $words;
    return $this;
  }

  /**
   * @param string $fieldname
   * @param string $message
   *
   * @return $this
   */
  public function addError(string $fieldname, string $message): louchebem
  {
    $this->errors[$fieldname] = $message;
    return $this;
  }

  /**
   * @param string $fieldname
   *
   * @return string|null
   */
  public function getErrorByFieldname(string $fieldname): ?string
  {
    return array_key_exists($fieldname, $this->errors) ? $this->errors[$fieldname] : null;
  }

  /**
   * @return array
   */
  public function getErrors(): array
  {
    return $this->errors;
  }

  /**
   * @param array $errors
   *
   * @return $this
   */
  public function setErrors(array $errors): louchebem
  {
    $this->errors = $errors;
    return $this;
  }

}