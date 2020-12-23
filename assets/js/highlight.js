import highlight from 'highlight.js/lib/core';
import php from 'highlight.js/lib/languages/php';
import twig from 'highlight.js/lib/languages/twig';

highlight.registerLanguage('php', php);
highlight.registerLanguage('twig', twig);

highlight.initHighlightingOnLoad();
