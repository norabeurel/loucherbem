<?php
include "Request.php";
include "Word.php";

class Loucherbem
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
  public function execute(): Loucherbem
  {
    if($this->request->isPost())
    {
      if(!$this->request->get('word'))
      {
        $this->addError("word", "Cette valeur est requise !!!");
      }
      if(!$this->request->get('terminaison'))
      {
        $this->addError("terminaison", "Cette valeur est requise !!!");
      }

      if(count($this->errors) <= 0)
      {
        $words = explode(" ", $this->request->get("word"));
        foreach ($words as $word)
        {
          $this->addWord($word, $this->wordTransform($word));
        }
      }
    }
    return $this;
  }

  /**
   * @param string $word
   *
   * @return string
   */
  protected function wordTransform(string $word): string
  {
    $firstChar = substr($word,0,1);
    $firstChar = strtolower($firstChar);

    $afterFirstChar = substr($word,1);
    $afterFirstChar = strtolower($afterFirstChar);

    return "L{$afterFirstChar}{$firstChar}{$this->request->get("terminaison")}";
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
  public function setTerminaisons(array $terminaisons): Loucherbem
  {
    $this->terminaisons = $terminaisons;
    return $this;
  }

  /**
   * @param string $word
   * @param string|null $wordTransform
   *
   * @return $this
   */
  public function addWord(string $word, ?string $wordTransform = null): Loucherbem
  {
    $this->words[] = new Word($word, $wordTransform);
    return $this;
  }

  /**
   * @return string
   */
  public function viewTransformWords(): string
  {
    $wordTransform = array();
    /** @var Word $word */
    foreach($this->getWords() as $word)
    {
      $wordTransform[] = $word->getWordTransform();
    }
    return implode(" ", $wordTransform);
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
  public function setWords(array $words): Loucherbem
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
  public function addError(string $fieldname, string $message): Loucherbem
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
  public function setErrors(array $errors): Loucherbem
  {
    $this->errors = $errors;
    return $this;
  }

}