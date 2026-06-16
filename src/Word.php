<?php

class Word
{

  /**
   * @var string
   */
  protected string $word;

  /**
   * @var string|null
   */
  protected ?string $wordTransform = null;

  /**
   * Construct Word
   */
  public function __construct(string $word, ?string $wordTransform = null)
  {
    $this->word = $word;
    $this->wordTransform = $wordTransform;
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

}