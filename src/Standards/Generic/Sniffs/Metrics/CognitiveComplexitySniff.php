<?php

declare(strict_types=1);

namespace PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\CognitiveComplexityAnalyzer;

final class CognitiveComplexitySniff implements Sniff
{
    /** @var int */
    public $maxComplexity = 15;

    /** @var CognitiveComplexityAnalyzer */
    private $analyzer;

    public function __construct()
    {
        $this->analyzer = new CognitiveComplexityAnalyzer();
    }

    /**
     * @return int[]
     */
    public function register(): array
    {
        return [T_FUNCTION];
    }

    /**
     * @param int $stackPtr
     */
    public function process(File $phpcsFile, $stackPtr): void
    {
        $tokens = $phpcsFile->getTokens();

        $cognitiveComplexity = $this->analyzer->computeForFunctionFromTokensAndPosition(
            $tokens,
            $stackPtr
        );

        $name = $tokens[$stackPtr + 2]['content'];

        $phpcsFile->addError(
            '%s:%d',
            $stackPtr,
            'TooHigh',
            [
                $name,
                $cognitiveComplexity
            ]
        );
    }
}