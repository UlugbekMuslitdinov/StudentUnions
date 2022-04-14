# UAQS Content Chunks

A library of pre-defined fieldable Drupal entities, based on the [Paragraphs](https://www.drupal.org/project/paragraphs) module, for use in conjunction with the University of Arizona's UA Zen theme. Paragraphs are like [Field collections](https://www.drupal.org/project/field_collection), which allow a host entity to contain a potentially long list of entities that themselves contain fields. but Paragraphs relaxes the requirement that all entities hosted in one place have the same structure. This makes them useful for chaining short varied pieces of content (for example as an alternative to the Body field).

Once enabled, the Paragraphs module lets a site designer add extra definitions for the little entities, in the same way that they could define multiple content types for full-scale nodes, and make the new types of field in the host entities at which the lists of Paragraphs can attach. UAQS Content Chunks adds a demonstration node type that can serve as a host to Paragraphs, *UAQS Flexible Page*, and some Paragraphs pre-defined to get custom HTML markup when used with the UA Zen theme.

## UAQS Column Image

An image with an optional credit and caption.

## UAQS File Download

A reference to a downloadable file, with optional preview image.

## UAQS Headed Text

A paragraph of text with a heading.

## UAQS Plain Text

A Paragraphs bundle type that is simply a paragraph.