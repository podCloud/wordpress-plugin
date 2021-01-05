wp.blocks.registerBlockVariation(
    "core/embed", 
    {
        name: 'podcloud',
        title: 'podCloud',
        keywords: [ 'podcast', 'audio' ],
        description: 'Embed podCloud content.',
        patterns: [
            /^https?:\/\/(www\.)?podcloud\.fr\/podcast\/.+/i,
            /^https?:\/\/.+\.(lepodcast|podcloud)\.fr(\/.*)?/i,
            /^https?:\/\/pdca\.st\/.+/i,
        ],
        attributes: { providerNameSlug: 'podcloud', responsive: true },
    }
);
