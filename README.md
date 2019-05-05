# ZendSearch component

Fork of `zendframework/zendsearch`.

The goal of this project is primarily to maintain a version of the original package that will work on newer PHP versions. It's not to:

* Add any additional functionality
* Maintain any sort of compatibility with Lucene
* Extend the scope of the original in any way

As such, any pull requests that do this WILL be rejected. However, if you want to use this project as a starting point for your own fork, be my guest.

However, in the long term I'd like to improve the quality of the package. As such, pull requests that do the following are welcome:

* Fix gaps in test coverage
* Fix potential errors identified by Psalm
* Fix any PSR 2 code style issues
* Updates to DocBlocks

## Why are you doing this?

While the original package has been abandoned and they recommend using something like Elasticsearch instead, that is often overkill for many sites. There's `teamtnt/tntsearch`, but that lacks features such as the ability to index Powerpoint documents. The main project I work on professionally at time of writing is an example of a site that may benefit from this package, in that it's arguably too small to be worth bothering with Elasticsearch, but using relational databases to search it is inadequate.
