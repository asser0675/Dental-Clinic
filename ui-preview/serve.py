"""Serve the Cerillo front-end prototype locally. Requires Python 3."""
from http.server import ThreadingHTTPServer, SimpleHTTPRequestHandler
from pathlib import Path
import os
import webbrowser
from threading import Timer
os.chdir(Path(__file__).resolve().parent)
if __name__ == '__main__':
    server = ThreadingHTTPServer(('127.0.0.1', 8000), SimpleHTTPRequestHandler)
    print('Cerillo Dental Clinic: http://localhost:8000')
    print('Keep this window open. Press Ctrl+C to stop.')
    Timer(0.7, lambda: webbrowser.open('http://localhost:8000')).start()
    try:
        server.serve_forever()
    except KeyboardInterrupt:
        server.server_close()
