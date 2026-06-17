<?php

class Word
{

  /**
   * @var string
   */
  protected string $word;

  /**
   * @var string
   */
  protected string $terminaison;

  /**
   * @var string|null
   */
  protected ?string $wordTransform = null;



  /**
   * Construct Word
   */
  public function __construct(string $word, string $terminaison)
  {
    $this->word = $word;
    $this->terminaison = $terminaison;
    $this->wordTransform = $this->wordTransform();
  }

  /**
   * @return string
   */
  public function getWord(): string
  {
    return $this->word;
  }

  /**
   * @param string $word
   *
   * @return $this
   */
  public function setWord(string $word): Word
  {
    $this->word = $word;
    return $this;
  }

  /**
   * @return string
   */
  public function getTerminaison(): string
  {
    return $this->terminaison;
  }

  /**
   * @param string $terminaison
   *
   * @return $this
   */
  public function setTerminaison(string $terminaison): Word
  {
    $this->terminaison = $terminaison;
    return $this;
  }

  /**
   * @return string|null
   */
  public function getWordTransform(): ?string
  {
    return $this->wordTransform;
  }

  /**
   * @param string|null $wordTransform
   *
   * @return $this
   */
  public function setWordTransform(?string $wordTransform): Word
  {
    $this->wordTransform = $wordTransform;
    return $this;
  }

  /**
   * @param string $word
   *
   * @return string
   */
  protected function wordTransform(): string
  {
    $word = $this->word;
    $firstChar = substr($word,0,1);
    $firstChar = strtolower($firstChar);

    $afterFirstChar = substr($word,1);
    $afterFirstChar = strtolower($afterFirstChar);

    return "L{$afterFirstChar}{$firstChar}{$this->terminaison}";
  }
}