The structure of the files in this folder are built to generate two main css files used in the theme. They each will load up the files they need. The two root files are:

- Main stylesheet (main.scss)
- Block editor style sheet (main-block.scss)

It is expected that each block will contain its own file (even if it is just a few lines of css). The naming convention is \_block-\[block name\].css to indicate the block name it applies to and keep all block styles together.

To reduce the number of redundant declarations for styles there is a variable file that is included: \_vars.scss

The `main.scss` file is included by the main stylesheets after their respective variable files are included.

The `main-block.scss` file is included by the block editor stylesheets after their respective variable files are included.
