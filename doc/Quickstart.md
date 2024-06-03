# Quickstart


## The different prelude environments



# Your first htfx template


## rendering


## Defining a Partial:

```
<?php namespace htfx\prelude\html5; return div(class: ['my-partial-component', 'component'])(

); 
```

Dont load partials by using include or require and such stuff, some
functions will get loaded twice and everything crashes.

## Defining a layout


## Combinding layouts and views


## Integrating with CSS


## Framework Integration


# Customization


## Creating your own prelude environment

Copy the environment


## Defining filters

Using filters you can manipulate the nodes before they are generated and sent to the client

