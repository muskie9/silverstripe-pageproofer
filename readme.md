# silverstripe-pageproofer

[![Build Status](https://travis-ci.org/muskie9/silverstripe-pageproofer.svg?branch=master)](https://travis-ci.org/muskie9/silverstripe-pageproofer) [![codecov.io](https://codecov.io/github/muskie9/silverstripe-pageproofer/coverage.svg?branch=master)](https://codecov.io/github/muskie9/silverstripe-pageproofer?branch=master)

Add PageProofer code snippet to websites via cms.

## Requirements

- [cms 3.2.x](https://github.com/silverstripe/silverstripe-cms)
- [framework 3.2.x](https://github.com/silverstripe/silverstripe-framework)

## Installation

**First:**

`composer require muskie9/pageproofer`

**Then:**

`http://yoursite.com/dev/build?flush=all`

## Sample Usage

Add PageProofer Codes in the Site Settings admin:

![Code Location CMS](/docs/en/images/code-location-cms.gif)

The code is automagically added to the page if the code domain matches your current domain and the code is enabled (both in Page Proofer and the cms):

![Code Location Browser](/docs/en/images/code-location-browser.gif)

## Documentation

See the [docs/en](docs/en/index.md) folder.