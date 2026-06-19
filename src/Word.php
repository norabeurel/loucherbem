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
   * @var array
   */
  protected array $voyelle = array('a', 'à', 'â', 'e', 'é', 'è', 'ê', 'ë', 'i', 'î', 'ï', 'o', 'ô', 'u', 'ù', 'û', 'ü', 'y', 'ÿ', 'œ');

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
   *
   * @return string
   */
  protected function wordTransform(): string
  {
    $word = $this->word;
    $startLetter = substr($word,0,1);
    $louchebemPrefix = ctype_upper($startLetter) ? "L" : "l";

    $word = strtolower($word);
    $startLetter = strtolower($startLetter);
    if (in_array($startLetter, $this->voyelle)) {
      return "{$louchebemPrefix}{$word}{$this->terminaison}";
    }
    $letters = mb_str_split(substr($word, 1), 1, "UTF-8");
    foreach ($letters as $letter) {
      if (!in_array($letter, $this->voyelle)) {
        $startLetter .= $letter;
      } else {
        break;
      }
    }
    $afterStartLetter = str_replace($startLetter, "", $word);
    return "{$louchebemPrefix}{$afterStartLetter}{$startLetter}{$this->terminaison}";

  }
}