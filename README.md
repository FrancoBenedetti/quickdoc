# QUICKDOC MANUAL PUBLISHER
Quickdoc is a simple php-based application that allows a collection of Google Docs to be used to present an online user manual or documentation.

Simply use Google Docs to create the different parts of your user manuals and then expose these to your users using Quickdocs.

Only users that have been granted permission to edit the underlying Google Docs document, will be able to do so from the like available on the ‘edit’ link in the right side bar menu.

For documents to be viewable publicly, the linked Google Docs document must be shared using Publish to the Web.

## Installation

The quickdoc folder 'manual' folder should be copied into the root. This folder may be renamed however you like, e.g. 'documentation', 'user-guide' or 'help'.

If you've used 'manual', then access the sample manual by using, e.g. https://yourdomain.com/manual. Be aware that if there are links between manuals, these links may require changes when the manual root folder name is changed.

Add more folders and insert your instructions into the quickdoc.json to create more manuals and chapters of manuals.

## See Also

[User Guide](https://docs.google.com/document/d/e/2PACX-1vRJDStiNjCz7vzgTFa0WDdkdKNkTqJYq-hJ4D_1vr1kiDIQTs5FVk4479r_LRdGriwOraOtgWoiJKUC/pub)

[Developer Guide](https://docs.google.com/document/d/e/2PACX-1vSm0DpchhzAVBRl6q81T_WbQrM6-cVyppcUadu5VIgyO2GZ3o8ulr0-cqnKJQMWubpCmfFEyZDf2mDh/pub)

[Live example](https://bizverse.biz/quickdoc)

## Acknowledgements
A simple php dom parser has been inorporated into Quickdoc as simple_html_dom.php, which file is used under MIT license:
 * Website: http://sourceforge.net/projects/simplehtmldom/
 * Additional projects: http://sourceforge.net/projects/debugobject/
 * Acknowledge: Jose Solorzano (https://sourceforge.net/projects/php-html/)
 
