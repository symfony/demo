var hljs = require('highlight.js/lib/highlight.js');

hljs.configure({
    languages: ['twig', 'php']
});

hljs.initHighlightingOnLoad();

module.exports = hljs;
