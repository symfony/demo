An excerpt pf Polyconseil Git/GitHub guidelines

==============
Git and GitHub
==============

This page does not serve as an introduction to Git. If you are new to
Git, see its `official documentation
<http://git-scm.com/documentation>`_ or this `visual Git reference
<http://marklodato.github.io/visual-git-guide/index-en.html>`_. This
`visual cheatsheet <http://www.ndpsoftware.com/git-cheatsheet.html>`_
may also help.


Our workflow
============

Our workflow is pretty simple. For each project, it involves:

- a ``master`` branch;

- feature branches that we use with Git Hub pull requests and that we
  delete once the changes are merged in the ``master`` branch;

- for some projects, a branch called ``prod``, created from the
  ``master`` branch, that is used to create the release;

- a tag for each released version of the project.


.. warning::

   Do **not** push force (``git push -f``) on any shared branch like
   ``master`` or ``prod``. Never. Other developers will throw nerf
   guns at you until exhaustion. Your exhaustion. And this mistake
   will cost you a month long "croissants" fine.

   However, you may push force on a feature branch if you are the only
   one working on it, or if your fellow developers do not mind.


Pull requests
-------------

Let's suppose that you have a change to make in a project.

Unless your change is obvious, you should seek approval from other
developers of the project. To do so, first create a branch locally:

.. code:: bash

   $ git checkout -b jsmith/trac_1234_fix_frobulation

The name of your branch should start with your username and a slash,
include a ticket number if one exists, and a very short textual
description.

When on your new branch, do your changes, add your files and commit.
You may commit more than once. The messages of your commits do not
really matter yet as they are not the final commit that you will push
on the ``master`` branch.

Once you are happy with the changes on your feature branch, push it to
GitHub:

.. code:: bash

   $ git push origin jsmith/trac_1234_fix_frobulation

On the project page on GitHub, you should see the message "Your
recently pushed branches" and a button to "compare & pull
request". Click on it and you will be presented the pull request add
form. Provide a title (the name of your branch may not be clear
enough) and explain what the pull requests does. If there is a Trac
ticket, mention it. Note that other developers who will review your
pull requests may not have all the context you have and that the
changes may not be as straightforward as you may think.

Once your pull request has been reviewed and you have made the
necessary changes (if any), it is time to push your changes on the
``master`` branch. **Do not** use the "Merge pull request" button from
GitHub. We do not use merge as it adds unnecessary merge commits.

First, squash commits if needed. When working on a large set of
changes, we usually make temporary commits ("work in progress", "fix
part 1 of the blobs", etc.). We do not want to see these temporary
commits on the ``master`` branch, so we will squash them now.

Note that you may want not to squash all your changes into a single
commit. Each commit should be atomic: consistent, complete,
self-explanatory (i.e. it should not depend on a previous commit).
Hence, if you have made unrelated changes, it is probably better to
keep separated commits. However, if your second commit is a mere
enhancement of the first one (perhaps taking in account review
comments), you should probably squash them as a single commit.

To squash commits, use ``git rebase -i HEAD~N`` where N is the number
of commits that you want to edit. You may need to type ``git log`` to
find out this number. Follow the instructions given by ``rebase`` and
finally type ``git log`` to check the resulting commit(s).

Then, get back to your ``master`` branch and pull recent changes:

.. code:: bash

   $ git checkout master
   $ git pull --rebase

Now switch to your branch and rebase it from master:

.. code:: bash

   $ git checkout jsmith/trac_1234_fix_frobulation
   $ git rebase master

The last command may inform you that you have conflicts. If so, follow
the instructions. For each conflict, merge the changes manually by
editing the file and type ``git add thefile``. Once all files have
been edited, type ``git rebase --continue``.

When your branch has been rebased and that you are happy with it, you
may push the changes to the ``master`` branch. To do so, rebase the
``master`` branch on your feature branch:

.. code:: bash

   $ git checkout master
   $ git rebase jsmith/trac_1234_fix_frobulation

By typing ``git log``, you will then see on the ``master`` branch the
commit(s) that you added in your feature branch. If everything looks
good, you may pull recent changes and push yours:

.. code:: bash

   $ git pull --rebase
   $ git push

Once your changes have been pushed to ``master``, your pull request
can be closed. You may want to add a comment on it with a message like
"Pushed to ``master`` with id_of_commit_on_master". Also, your feature
branch is now useless. You may delete it locally and remotely:

.. code:: bash

   $ git branch -D jsmith/trac_1234_fix_frobulation
   $ git push --delete origin jsmith/trac_1234_fix_frobulation


On reviewing pull requests
--------------------------

Reviewing a pull request implies commenting on:

- general architecture and possible breakage introduced by the
  proposed changes in the "grand scheme of things" of the project;

- missing tests;

- bugs;

- coding style and readability.

Reviewing is not an easy task but is a very important part of our
workflow. A few tips:

- reviewing takes time. As the reviewer, prefer to be comprehensive
  rather than quick. As the reviewee, be patient and do not
  necessarily expect a 10-minute review on a large set of changes;

- when requesting a review, take some distance with your code: your
  code is not you. The reviewer wants to help. The reviewer reviews
  **the code**, they **do not review you**;

- when reviewing, be kind: do no point the finger but rather propose
  corrections;

- when reviewing, be bold: commenting with a single "?" may not be as
  meaningful as you may think. If you think that there is an obvious
  mistake, then your comment should be easy to write.

Discussing issues *ad infinitum* through GitHub comments does not lead
anywhere (except frustration). If you plan to reply to a reply of a
reply, don't: discuss it in real life or on Slack.


On writing commit messages
--------------------------

Commit messages are hard to write. Let's go shopping. No, wait. Here
are a few tips:

- the first line of the message should be short enough to be displayed
  in any user interface (i.e. less than 70 characters) and yet provide
  enough information for the reader in a hurry;

- the first line may include a reference to a Trac ticket, for example
  "[closes #1234]" if it fixes the bug that is reported in the ticket,
  or "[refs #1234]" if the commit is only related to the ticket.

- if the commit implies anything that is visible (a new interface, a
  change in an existing interface, the correction of a visible bug,
  etc.), it should be linked to a Trac ticket.

- the first line should start with the scope of your changes (usually
  the application in a Django project, or the sub-package or module in
  a Python library in general), so that other users can easily spot
  commits in the area they care about. For example, you can mention
  "core.cars", "www.gifts", etc.

- provide information about the changes in the message, especially if
  you could not provide these informations within the changes
  themselves (as Python comments, for example).

  By reading the changes themselves, the reader will know (with more
  or less work) **what** has changed. But the reader may not
  understand **why** it has changed: this is why the commit message is
  important. Think of the future reader as someone who does not have
  any context about the commit.

  Be bold and entertain the curious readers. Example::

    customersheets: Do not compress blobs for Slish. [closes #1234]

    Before this commit, we used to compress blobs before sending them
    to the Slish web service. The gain was minor but not negligible.
    As of Septembre 2015, Slish does not handle compressed blobs
    anymore.

Revert commits are not different. If you revert a commit, explain why.
Perhaps the initial commit was a work in progress and you did not
intend to push it, or perhaps you discovered a bug or something later
on. In the latter case, we want to know. At least, the developer who
will review the commits, does want to know.
