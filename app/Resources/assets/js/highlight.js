import hljs from 'highlight.js/lib/highlight';
import php from 'highlight.js/lib/languages/php';
import twig from 'highlight.js/lib/languages/twig';

hljs.registerLanguage('php', php);
hljs.registerLanguage('twig', twig);

hljs.initHighlightingOnLoad();
