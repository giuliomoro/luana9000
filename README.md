# Luana9000 : a MIDI to webserver translator
Uses Bome's Midi Translator to receive MIDI messages from Cubase, writes a text file which is then read by the webserver when it is polled through AJAX.
The textfile contains info on what DIV should be displayed and how long it should take to fade in/out. The list of divs is stored in a MySQL database.

Many improvements would be welcome, e.g.:
- use node+json  or node+mysql instead of php+mysql
- use https://github.com/justinlatimer/node-midi to handle midi from the node webserver, thus getting rid of Bome's altogether

Responds to control changes received on MIDI channel 15:
- CC1(lsb) and CC2(msb) for scene selection
- CC11 for class selection (unused)
- CC12 for fade time (expressed in 0.1s , e.g.: a value of 8 is 800ms).
Values of CC1, CC11, CC12 are persistent (stored in Bome's global variables)
Sending a CC2 triggers the selection of a new scene.
