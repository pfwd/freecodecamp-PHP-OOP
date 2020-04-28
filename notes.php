<?php
/**
 * @todo Change bootstrap to routing.
 * Alter config to including routing config
 *
 * @todo Question, does a Exception with a code of 404 have a header of 404?
 * if so remove try catch
 *
 * @todo Check in View::Render that template exists
 *
 * @todo Put Connection creds into config.php
 *
 * @todo typo in creds
 * @todo put DB::Connection into a try catch and catch PDOException
 *
 * @todo Refactor query builder so that query statements are not exposed
 * EG QueryBuilder::where() from repository
 * Possibly have a interface that just exposes the find*, insert, insertOrUpdate and
 * update methods
 *
 * Haven't checked Helper or Manager yet!
 *
 * @todo Fix the failing 404 acceptance tests
 * vendor/bin/codecept run acceptance -g page-not-found
 * it is failing due to not running /public/404.html
 *
 *
 * @todo Add abstraction layer for repositories to allow controllers to pull out
 * repositories from a factory
 * EG:
 * $this->getDoctrine()->getRepository(\App\Entity\Status::class)->findAll()
 * $this->repostioryFactory()->make(\App\Entity\Status::class)->findAll()
 *
 * $this->getDB()->getRepository(\App\Entity\Invoice::class)->findAll();
 *
 * $this->repositoryLoader->getStatus()->findAll();
 *
 * @todo Add abstraction layer for managers to allow controller to pull out
 * managers from a factory
 * $this->getDB()->getManager(\App\Entity\Status::class)->save($status);
 *
 *
 *
 */
